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
use PhpParser\Node\Stmt\TryCatch;

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

    // public function getPendingExtensionRequest(){
    //     try {
    //         DB::beginTransaction();
            
    //         $extension_request_instance = ExtensionRequest::where('extension_status', 'Pending')->get();

    //         if ($extension_request_instance->isEmpty()){
    //             return response()->json([
    //                 "status"=> "Successfully fetched the data",
    //                 "message"=>"No pending extension request found",
    //                 "data"=>[],
    //             ], 200);
    //         }

    //         DB::commit();

    //         return $extension_request_instance;

    //     } catch (\Throwable $th) {
    //         DB::rollBack();
        
    //         return response()->json([
    //             "status" => "Failed",
    //             "message" => $th->getMessage(),s
    //            ], 500);     
    //     }
    // }


    //add condition if the fetched instance has a status of pending it will update the extension status and if the status is approved a message will show that the request is already approvesd
    public function updateExtensionRequestStatus($id){
        $approved_status = 'Approved';

        try{
            DB::beginTransaction();

            $extension_request_instance = ExtensionRequest::findOrFail($id);
            if ($extension_request_instance->extension_status === $approved_status){
                return response()->json([
                    "status" => "Info",
                    "message" => "Extension status is already approved.",
                ],200);
            }
            $extension_request_instance->extension_status = $approved_status;
            $extension_request_instance->save();
            
            DB::commit();

            return response()->json([
                "status" => "Success",
                "message" => "Extension status updated successfully!",
                "data" => new ExtensionTimeResource($extension_request_instance),
               ], 200);

        }catch (\Throwable $th) {
            DB::rollBack();
        
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);     
        }
    }
}
