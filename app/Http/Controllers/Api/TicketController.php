<?php

namespace App\Http\Controllers\api;

use App\Events\TicketQueue;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TaskTypeResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\UserClientTypeResource;
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



        /**
     * checks if the user_id and client_type_id already exist in user_client_type table
     */
    public function checkIfUserClientTypeExists(string $userId, string $clientTypeId)
    {
        $userClientType = UserClientType::where('user_id', $userId)
                                        ->where('client_type_id', $clientTypeId)
                                        ->first();
    
        if ($userClientType) {
            return $userClientType->id;
        }
    
        try{
            DB::beginTransaction();

            $data = UserClientType::create([
                'user_id' => $userId,
                'client_type_id' => $clientTypeId,
            ]);

            DB::commit();

            return new UserClientTypeResource($data);

         }catch(\Throwable $th){
            DB::rollBack();

            return response()
            ->json([
                "message" => $th->getMessage()
            ], 500);
         }
    }


    
    private function extractClientType(string $taskTypeId)
    {
        $clientType = ClientType::find($taskTypeId);
        if ($clientType === null) {
            // Log or handle the case where client type is not found
            return null;
        }
        return $clientType;
    }
    
    private function extractTaskType(string $clientTypeId)
    {
        $taskType = TaskType::find($clientTypeId);
        if ($taskType === null) {
            // Log or handle the case where task type is not found
            return null;
        }
        return $taskType;
    }
    
    private function extractUserClientType(string $userClientTypeId)
    {
        $userClientType = UserClientType::find($userClientTypeId);
        if ($userClientType === null) {
            // Log or handle the case where user client type is not found
            return null;
        }
        return $userClientType;
    }
    

    public function queue(string $ticketStatus)
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
            $userClientType = $this->extractUserClientType($userClientTypeId);
            
            $clientTypeId = $userClientType->client_type_id;
            
            $clientType = $this->extractClientType($clientTypeId);
            $taskType = $this->extractTaskType($taskTypeId);
    
            // If a matching task type is found, add its ID to the result array
            if ($taskType && ($ticketStatus === "All Items" ? $ticket->ticket_status !== $ticketStatus : $ticket->ticket_status === $ticketStatus)) {
                $obj = new \stdClass();
    
                // Populate the object with data
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
                
                // from client_types table
                $obj->importance = $clientType->importance;
                $obj->client_type = $clientType->name;
    
                // insert object in this array
                $combinedArr[] = $obj;
            }
        }
        
        // Return the combined array containing the tickets with their importance
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
        $ticket = $request->validated();

        $userClientTypeId = $this->checkIfUserClientTypeExists($ticket['user_id'], $ticket['client_type_id']);

        $clientTypeId = $ticket['client_type_id'];
        unset($ticket['client_type_id']);

        // $ticket['user_id'] = $userClientTypeId; //to be changed into user_client_type_id

        // save the data to the ticket table
        try {
            DB::beginTransaction();

            $ticketData = Ticket::create($ticket);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }

        $createdTicketData = new TicketResource($ticketData);
        
        // getting the importance from client type table for queueing
        $clientType = $this->extractClientType($clientTypeId);
        $taskType = $this->extractTaskType($ticket['task_type_id']);

        // event for realtime updating in the queue
        event(new TicketQueue($createdTicketData['ticket_id'],$userClientTypeId, $ticket['task_type_id'], $ticket['ticket_status'], $ticket['reference_date'],$taskType->task, $taskType->category_id, $taskType->difficulty,$taskType->urgency, $clientType->importance,$clientType->name));

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
