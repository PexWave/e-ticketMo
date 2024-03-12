<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleRequest $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {   
        try {
            $role = Role::firstOrCreate($request->validated());
            return response()->json(["message" => "Successfully created role"], 201);
          } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
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
    public function update(RoleRequest $request, string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->update($request->validated());
            return response()->json(["message" => "Successfully updated Role"], 500);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => $th->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json(["message" => "Role deleted successfully"], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Role not found"], 404);
        }
    }
}
