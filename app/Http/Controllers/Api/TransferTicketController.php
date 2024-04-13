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

            $transferred_ticket_instance->transferred_to = $transferred_to;
            $transferred_ticket_instance->transferred_by = $assigned_to;
            $transferred_ticket_instance->transfer_request_date = $currentTime;
            $transferred_ticket_instance -> save();

            DB::commit();
            return response()->json([
                "status" => "Success",
                "message" => "Request Transfer of ticket was successful!",
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
