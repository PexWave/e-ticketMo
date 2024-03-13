<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItStaffRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ItStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(ItStaffRequest $request)
    {
        try {
        $validatedData = $request->validated();
        //CHECK IF USER EXIST, IF NOT, CREATE USER
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'office_id' => $validatedData['office_id'],
        ]);
        
        //CREATE IT STAFF DATA, ASSIGN CATEGORY

        //ASSIGN ROLE


        return response()
        ->json([
            "message" => "Successfully created IT Staff"
        ], 201);

        } catch (\Throwable $th) {
            //throw $th;

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}