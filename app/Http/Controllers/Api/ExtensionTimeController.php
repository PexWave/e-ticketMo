<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExtensionTimeRequest;
use App\Http\Resources\ExtensionTimeResource;
use App\Models\ExtensionRequest;
use App\Models\Ticket;
use Carbon\Carbon;
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
    public function store(ExtensionTimeRequest $request, $id)
    {
        $extensionTime = $request->validated();

        $extension_request = $this->requestExtension($id, $extensionTime['requested_by'], $extensionTime['reason']);


        echo $extension_request;
        return new ExtensionTimeResource($extension_request);
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

    public function requestExtension($id, $it_employee_id, $reason){
        try {
        DB::beginTransaction();
        //get id ticket using router "/extensionRequest/{ID}"
        $ticket_instance = Ticket::findOrFail($id);


        $currentTime = Carbon::now();
       
        // create an extension based sino nag create ng request
        $request_extension = ExtensionRequest::create([
            'ticket_id' => $ticket_instance->id,
            'extension_time' =>  $currentTime->addHour(),
            'requested_by' => $it_employee_id,
            'reason' => $reason,
        ]);

        DB::commit();

        return $request_extension;
        
        // id galing sa ticket table ma store sa ticket_id na attribute under extension table
        //extension request was created pero yung status niya is pending , since hnd pa na approve ni supervisor
        //yung status ng extension request will updated to approved

        } catch (\Throwable $th) {
            DB::rollBack();
        
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
        }
    }
}
