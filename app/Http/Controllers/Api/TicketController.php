<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
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

        return new TicketResource($ticketData);
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
