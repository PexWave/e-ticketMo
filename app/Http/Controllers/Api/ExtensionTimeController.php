<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExtensionTimeRequest;
use App\Http\Resources\ExtensionTimeResource;
use App\Models\ExtensionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ExtensionTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExtensionTimeResource::collection(ExtensionRequest::all());
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
    public function store(ExtensionTimeRequest $request)
    {
        $extensionTime = $request->validated();


        try {
            DB::beginTransaction();

            $extensionTimeData = ExtensionRequest::create($extensionTime);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }

        return new ExtensionTimeResource($extensionTimeData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
    public function update(ExtensionTimeRequest $request, string $id)
    {
        try {
            $extentionData = ExtensionRequest::findOrFail($id);
            $extentionData->update($request->validated());
            return response()->json([
                "status" => "Success",
                "message" => "Extension data updated successfully!",
                "data" => new ExtensionTimeResource($extentionData),
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
            $extensionData = ExtensionRequest::findOrFail($id);
            $extensionData->delete();
            return response()->json([
                "status" => "Success",
                "message" => "Extension data deleted successfully!",
                "data" => new ExtensionTimeResource($extensionData),
               ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }
    }

    public function requestExtension(string $ticketID){
        
    }
}
