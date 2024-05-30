<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoriesResource::collection(Category::all());
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
    public function store(CategoriesRequest $request)
    {

        $category = $request->validated();


        try {
            DB::beginTransaction();

            $categoryData = Category::create([
                "name" => $category['name']
            ]);

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "status" => "Failed",
                "message" => $th->getMessage(),
               ], 500);        
            }

        return new CategoriesResource($categoryData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return $category;
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


    public function update(CategoriesRequest $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update($request->validated());
            return response()->json([
                "status" => "Success",
                "message" => "Category updated successfully!",
                "data" => new CategoriesResource($category),
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
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                "status" => "Success",
                "message" => "Category deleted successfully!",
                "data" => new CategoriesResource($category),
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
