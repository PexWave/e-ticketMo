<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Office;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $userRequest)
    {
        try{
            $user = User::create($userRequest->validated());
            return response()->json([
                "message"=>"User was successfully created!"
            ], 200);


        }catch(\Throwable $th){
            return response()->json([
                "message"=> $th->getMessage(),
            ],500) ;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UserRequest $userRequest, string $id)
    {
        try{
            $user_instance = User::findOrFail($id);
            $user_instance->update($userRequest->validated());
            return response()->json(["message"=>"Successfully updated the user"], 200);
        }catch(\Throwable $th){
            return response()->json(["message"=>$th->getMessage(),] ,500) ;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user_instance = User::findOrFail($id);
            $user_instance->delete();
            return response()->json(["message"=> "User deleted"], 200);
        }catch(\Throwable $th){
            return response()->json(["message"=>$th->getMessage(),], 500);
        }
    }
}
