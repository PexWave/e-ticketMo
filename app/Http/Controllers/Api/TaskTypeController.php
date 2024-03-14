<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskTypeRequest;
use App\Models\TaskType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskTypeController extends Controller
{
    public function index()
    {
        //
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
       //
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
       try{
        DB::beginTransaction();
        $task_type_instance=TaskType::findOrFail($id);
        $task_type_instance->delete();

        DB::commit();
        return response()->json(["message"=> "Task deleted"], 200);
       }catch(\throwable $th){
        DB::rollBack();
        
        return response()->json(["message"=>$th->getMessage(),], 500);
       }
    }
}
