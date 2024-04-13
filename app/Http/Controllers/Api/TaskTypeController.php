<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskTypeRequest;
use App\Http\Resources\TaskTypeResource;
use App\Models\TaskType;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskTypeController extends Controller
{
    public function index()
    {
        return TaskTypeResource::collection(TaskType::all());
    }

    public function create(Request $request)
    {
        //
    }

    
   public function store(TaskTypeRequest $request)
   {   
      try{
        DB::beginTransaction();

        $task_type=TaskType::create($request->validated());
        DB::commit();
        return response()->json([
            "message"=>"task was successfully created"
        ], 200);
       
      }catch(\throwable $th){
        DB::rollBack();

        return response()
            ->json([
                "message" => $th->getMessage()
            ], 500);
      }
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
        $tasktype = TaskType::findOrFail($id);
        return $tasktype;
   }

   public function edit(string $id)
    {
        //
    }

    
    public function update(TaskTypeRequest $request, string $id)
    {
        try{
            DB::beginTransaction();
            $task_type_instance=TaskType::findOrFail($id);
            $task_type_instance->update($request->validated());
            DB::commit();
            return response()->json([
                'message'=> 'Task was updated successfully'
            ],200);
        }catch(\throwable $th){
            DB::rollBack();
            return response()
            ->json([
                "message"=> $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
    
            $task_type_instance = TaskType::findOrFail($id);
    

            // Check if there are any related tickets
            if ($task_type_instance->tickets()->exists()) {
                return response()->json(["message" => "Cannot delete Task type because it has tickets under it."], 400);
            }

            // Delete the taskType if no related records exist
            $task_type_instance->delete();

            

            DB::commit();

            return response()->json([
                "status" => "Success",
                "message" => "Task Type deleted successfully!",
               ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
    
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
    
    
    
    
    
}
