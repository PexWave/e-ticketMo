<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientTypeRequest;
use App\Http\Resources\ClientTypeResource;
use App\Models\ClientType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ClientTypeResource::collection(ClientType::all());
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
    public function store(ClientTypeRequest $request)
    {
        $clientType = $request->validated();

        try {
            DB::beginTransaction();

            $clientTypeData = ClientType::create([
                "name" => $clientType['name'],
                "importance" => $clientType['importance'],
                "office_id" => $clientType['office_id'],
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }

        return new ClientTypeResource($clientTypeData);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientType = ClientType::findOrFail($id);
        return $clientType;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientTypeRequest $request, string $id)
    {
        try {
            $clientType = ClientType::findOrFail($id);
            $clientType->update($request->validated());

            return response()->json([
                "status" => "Success",
                "message" => "Category updated successfully!",
                "data" => new ClientTypeResource($clientType),
               ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $clientType = ClientType::findOrFail($id);
            $clientType->delete();

            return response()->json([
                "status" => "Success",
                "message" => "Category updated successfully!",
                "data" => new ClientTypeResource($clientType),
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
