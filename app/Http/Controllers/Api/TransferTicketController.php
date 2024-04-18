<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Http\Resources\TicketResource;
use App\Http\Requests\TicketRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransferTicketController extends Controller
{
    public function modifytransferTicket($id, $transferred_to){
        try {
            DB::beginTransaction();
            $currentTime = Carbon::now();

            $transferred_ticket_instance = Ticket::findOrFail($id);
            $assigned_to = $transferred_ticket_instance->assigned_to;
            $ticket_number = $transferred_ticket_instance->ticket_number;
            $modified_date = $transferred_ticket_instance->modified_date;
            $reference_date = $transferred_ticket_instance->reference_date;

            $transfer_ticket = Ticket::create([
                'assigned_to' => $assigned_to,
                'ticket_number' => $ticket_number,
                'modified_date' => $modified_date,
                'reference_date' => $reference_date,
                'transfer_ticket_date' => $$currentTime,
            ]);

            DB::commit();

            return response()->json([
                "status" => "Success",
                "message" => "Request Transfer of ticket was successful!",
                "data" => new TicketResource($transfer_ticket),
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
