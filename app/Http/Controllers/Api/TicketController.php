<?php

namespace App\Http\Controllers\api;

use App\Events\TicketQueue;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TaskTypeResource;
use App\Http\Resources\TicketResource;
use App\Models\ClientType;
use App\Models\TaskType;
use App\Models\Ticket;
use App\Models\UserClientType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TicketResource::collection(Ticket::all());
    }


    public function queue()
    {   
        // Fetch all tickets
        $tickets = Ticket::all();
    
        // Initialize an empty array to hold the results
        $combinedArr = [];
    
        // Loop through each ticket
        foreach ($tickets as $ticket) {
            // Get the task type ID from the ticket table
            $taskTypeId = $ticket->task_type_id;
            $userClientTypeId = $ticket->user_id; // to be changed to userclienttypeid
    
            // Find the corresponding task type in the tasktype table
            $taskType = TaskType::find($taskTypeId);
            $userClientType = UserClientType::find($userClientTypeId);

            $clientTypeId = $userClientType->client_type_id;

            $clientType = ClientType::find($clientTypeId);
    
            // If a matching task type is found, add its ID to the result array
            if ($taskType && $ticket->ticket_status === 'Pending') {

                $obj = new \stdClass();

                // from tickets table
                $obj->ticket_id = $ticket->id;
                $obj->task_type_id = $ticket->task_type_id;
                $obj->user_client_type_id = $ticket->user_id;
                $obj->ticket_status = $ticket->ticket_status;
                $obj->reference_date = $ticket->reference_date;

                // from task_types table
                $obj->task = $taskType->task;
                $obj->category_id = $taskType->category_id;
                $obj->difficulty = $taskType->difficulty;
                $obj->urgency = $taskType->urgency;
                $obj->response_time = $taskType->response_time;
                $obj->resolve_time = $taskType->resolve_time;
                
                // from user_client_types table
                $obj->client_type_id = $userClientType->client_type_id;
                
                // from client_types table
                $obj->importance = $clientType->importance;
                $obj->client_type = $clientType->name;

                // insert object in this array
                $combinedArr[] = $obj;
            }
        }
    
        // Return the combined array containing the IDs
        return $combinedArr;
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        // $ticket = $request->validated();
        event(new TicketQueue($request->input('importance'), $request->input('urgency'), $request->input('user_id'), $request->input('ticket_status'),$request->input('actual_response'), $request->input('actual_resolve'), $request->input('modified_date'),$request->input('reference_date'), $request->input('remarks'),$request->input('task_type_id')));

        // try {
        //     DB::beginTransaction();

        //     $ticketData = Ticket::create($ticket);

        //     DB::commit();

        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return response()->json([
        //         "status" => "Failed",
        //         "message" => $th->getMessage(),
        //        ], 500);        
        //     }

        // return new TicketResource($ticketData);

        return [];

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        return $ticket;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, string $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->update($request->validated());
            return response()->json([
                "status" => "Success",
                "message" => "Ticket updated successfully!",
                "data" => new TicketResource($ticket),
               ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);    

            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // $ticket = Ticket::findOrFail($id);
            // $ticket->delete();
            // return response()->json([
            //     "status" => "Success",
            //     "message" => "Ticket deleted successfully!",
            //     "data" => new TicketResource($ticket),
            //    ], 200);


            $task_type_instance = Ticket::findOrFail($id);
    

            // Check if there are any related tickets
            if ($task_type_instance->extension_requests()->exists()) {
                return response()->json(["message" => "Cannot delete Ticket because there is/are extension time data under it."], 400);
            }

            // Delete the taskType if no related records exist
            $task_type_instance->delete();

            

            DB::commit();

            return response()->json([
                "status" => "Success",
                "message" => "Ticket deleted successfully!",
               ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }
    }
}
