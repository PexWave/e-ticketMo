<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Models\ITEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Throw_;

class AssigningTicketController extends Controller
{


    private function filterEmployees($filters) {
        try {
            
        return DB::table('it_employees')
        ->where('skill_level', '>=', $filters['difficulty'])
        ->where('category',$filters['category'])
        ->where('staff_status','Available');

        } catch (\Throwable $th) {
            throw $th->getMessage();       
        }
    }

    //FUNCTION FOR ASSIGNING EMPLOYEE TO A TICKET
    public function assignTicketToEmployee($tickets)
    {   
        //filter employee base on skill level (difficulty) and category of ticket
        foreach ($tickets as $ticket) {
            $filteredEmployees = $this->filterEmployees($ticket);
            // Check if any employees were found

            if ($filteredEmployees->isEmpty()) {
                // Handle the case where no employees match the filter (log, display message, etc.)
                continue;
            }
            // Get employee with lowest resolved tickets (considering ties)
            $lowestTicketResolved = $filteredEmployees->min('tickets_resolved');
            $employeesWithLowest = $filteredEmployees->where('tickets_resolved', $lowestTicketResolved);

            // Randomly choose one employee if multiple have the lowest resolved tickets
            if ($employeesWithLowest->count() > 1) {
                $employee = $employeesWithLowest->random();
            } else {
                $employee = $employeesWithLowest->first(); // Only one employee with the lowest resolved tickets
            }
        
            // Assign ticket to employee 
            $ticket->update(['employee_id' => $employee->id]);
        }
        


    }
}
