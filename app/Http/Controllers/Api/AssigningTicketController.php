<?php

namespace App\Http\Controllers\Api;


use App\Events\TicketQueue;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssigningTicketRequest;
use Illuminate\Support\Facades\Facade;
use App\Models\ITEmployee;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;

use function PHPSTORM_META\map;

class AssigningTicketController extends Controller
{


    private function filterEmployees($filters) {
        try {
        $filtered_by_category = array_pluck($filters, 'category_id');
        $filtered_by_difficulty = array_pluck($filters, 'difficulty');
        
        return DB::table('it_employees')
        ->where('staff_status', 'Available')
        ->join('it_employees_categories', 'it_employees.id', '=', 'it_employees_categories.it_employee_id')
        ->where('skill_level', '>=', min($filtered_by_difficulty)) // Moved to WHERE clause
        ->whereIn('it_employees_categories.category_id', $filtered_by_category)  
        ->groupBy('it_employees.id') 
        ->get();

        } catch (\Throwable $th) {
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);   
        }
    }

    //FUNCTION FOR ASSIGNING EMPLOYEE TO A TICKET
    public function assignTicketToEmployee(Request $request)
    {   

        $jsonData = $request->json()->all();

        //filter employee base on skill level (difficulty) and category of ticket
        $collection_of_matching_employees = $this->filterEmployees($jsonData);


        //Extract ticket IDs from request
        $array_of_ticketIDs = array_pluck($jsonData, 'ticket_id');

        //Query all tickets
        $collection_of_ticket_instance = Ticket::with('it_employee')
        ->where('ticket_status','Pending')
        ->whereIn('id', $array_of_ticketIDs) 
        ->get();

        // Get employee with lowest resolved tickets (considering ties)
        $lowestTicketResolved = $collection_of_matching_employees->sortBy('resolved_tickets');


        //loop through all tickets and perform assigning
        foreach ($collection_of_ticket_instance as $ticket) {

            $availableEmployee = $lowestTicketResolved->filter(function ($employee) use ($ticket) {
                return $employee->staff_status === "Available" && $employee->skill_level >= $ticket->task_type->difficulty;
              })->first();

            if (!$availableEmployee) {
                // Handle the case where no employees match the filter (log, display message, etc.)
                break;
            }

            // Assign ticket to employee 
            $ticket->update([
                'assigned_to' => $availableEmployee->it_employee_id,
                'ticket_status' => "In Progress"
            ]);
                
            // Check for existence before update
            if ($ticket->it_employee) {
                $ticket->it_employee->update(['staff_status' => 'Assigned']);
            } else {
                // Handle the case where there's no related employee (log, message, etc.)
                ITEmployee::findOrFail($availableEmployee->it_employee_id)->update(['staff_status' => 'Assigned']);
            }

            //Change Staff Status to Assigned
            $availableEmployee->staff_status = 'Assigned';

            event(new TicketQueue(
             $ticket->id,$ticket->user_client_type_id, $ticket->task_type_id,
             $ticket->ticket_status, $ticket->reference_date,
             $ticket->task_type->task, $ticket->task_type->category_id, 
             $ticket->task_type->difficulty,$ticket->task_type->urgency, 
             $ticket->client_type->importance,$ticket->client_type->name
            ));

            }
    

        return response()->json([
            "status" => "Failed",
            "message" => 'success',
        ], 200); 

           
    }
}
