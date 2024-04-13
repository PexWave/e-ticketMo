<?php

namespace App\Http\Controllers\api;

use App\Models\Office;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;
use App\Http\Resources\OfficeResource;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OfficeResource::collection(Office::all());
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
    public function store(StoreOfficeRequest $request)
    {
        try{
            $office_request = $request->validated();
            $office = Office::create([
             "name"=> $office_request["name"],
            ]);
 
            return response()->json([
             "status" => "success",
             "message" => "office created successfully!",
             "data" =>  new OfficeResource($office),
            ]);
         }catch(\Throwable $th){
             return response()->json([
                 "message" => $th->getMessage(),
             ], 500);
             }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $office = Office::findOrFail($id);
        return $office;
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
    public function update(string $id, UpdateOfficeRequest $request)
    {
        try{
            $office_instance = Office::findOrFail($id);
            $office_instance->update($request->validated());

            return response()->json(["message"=>"Successfully updated the office"], 200);
        }catch (\Throwable $th){
            return response()->json(["message"=>$th->getMessage(),], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $office_instance = Office::findOrFail($id);
            $office_instance->delete();
            return response()->json(["message"=> "Office deleted successfully!"], 200);
        }catch(\Throwable $th){
            return response()->json(["message"=>$th->getMessage(),], 500);
        }
    }
}
