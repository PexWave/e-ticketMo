<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserClientTypeRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserClientController extends Controller
{
    public function store(UserClientTypeRequest $request)
    {
         try{
            DB::beginTransaction();
            $validatedData = $request->validated();

            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'middle_name' => $validatedData['middle_name'],
                'last_name' => $validatedData['last_name'],
                'username' => $validatedData['username'],
                'password' => $validatedData['password'],
                'office_id' => $validatedData['office_id'],
            ]);

            $userClientType = $user->clientType()->attach($validatedData['client_type']);

            DB::commit();
            
         }catch(\Throwable $th){
            DB::rollBack();

            return response()
            ->json([
                "message" => $th->getMessage()
            ], 500);
         }
    }

    public function update(UserClientTypeRequest $request, string $clientId)
    {
       try{
        DB::beginTransaction();
        $validatedData = $request->validated();

        // $user = User::whereHas('clientType', function($query) use($clientId){
        //     $query->where('id', $clientId);
        // })->first();

        $user = User::findOrFail($clientId);

        $user->update($validatedData['user_info']);
        $user->clientType()->sync($validatedData['client_type']);

        DB::commit();

        return response()
        ->json([
            'message'=> 'Client Info was updated successfully'
        ],200);
       }catch(\Throwable $th){
        DB::rollBack();

        return response()
        ->json([
            "message"=> $th->getMessage()
        ], 500);
       }
    }

  
    public function destroy(string $clientId)
    {
        try{
            DB::beginTransaction();

            $user = User::whereHas('clientType', function($query) use($clientId){
                $query->where('id', $clientId);
            })->first();

            $user->delete();

            DB::commit();
            

        }catch(\Throwable $th){
            DB::rollBack();

            return response()
            ->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
