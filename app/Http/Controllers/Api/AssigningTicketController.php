<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Http\Requests\AssigningTicketRequest;
use Illuminate\Support\Facades\Facade;
use App\Models\ITEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;

class AssigningTicketController extends Controller
{


    private function filterEmployees($filters) {
        try {
        $filtered_by_category = array_pluck($filters, 'category_id');
        $filtered_by_difficulty = array_pluck($filters, 'difficulty');

        return DB::table('it_employees')
            ->whereIn('category', $filtered_by_category)  // Filter by category IDs
            ->where('skill_level', '>=', min($filtered_by_difficulty))
            ->where('staff_status', 'Available')
            ->get();
        } catch (\Throwable $th) {
            throw $th->getMessage();       
        }
    }

    //FUNCTION FOR ASSIGNING EMPLOYEE TO A TICKET
    public function assignTicketToEmployee(Request $request)
    {   
        //filter employee base on skill level (difficulty) and category of ticket
        $collection_of_matching_employees = $this->filterEmployees($request);

        //Extract ticket IDs from request
        $array_of_ticketIDs = array_pluck($request, 'ticket_id');

        //Query all tickets
        $collection_of_ticket_instance = DB::table('tickets')
        ->whereIn('category', $array_of_ticketIDs)  // Filter by category IDs
        ->get();

        //loop through all tickets and perform assigning
        foreach ($collection_of_ticket_instance as $ticket) {

            if ($collection_of_matching_employees->isEmpty()) {
                // Handle the case where no employees match the filter (log, display message, etc.)
                break;
            }
            // Get employee with lowest resolved tickets (considering ties)
            $lowestTicketResolved = $collection_of_matching_employees->min('tickets_resolved');
            $employeesWithLowest = $collection_of_matching_employees->where('tickets_resolved', $lowestTicketResolved)->first();

            // Assign ticket to employee 
            $ticket->update(['employee_id' => $employeesWithLowest->id]);
        }
    

    }
}
