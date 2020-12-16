<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $rules = [
            'name' => 'required|min:3|string'
        ];

        $validator = Validator::make($data, $rules);

        if($validator->passes()){
            $category = Category::create([
                'name' => $request->name
            ]);
    
            return response()->json([
                "message" => "Category successfully created!",
                "category" => $category
            ], 200);
        }else{
            return response()->json([
                "error" => $validator->errors()->all()
            ], 422);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // returns entry mapped as Resource 
        return new CategoryResource($category);

        // returns entry as in DB
        // $foundCategory = Category::findOrFail($category);
        // return response()->json($foundCategory);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->only(['name']));

        // return new CategoryResource($category);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            "message" => "Successfully deleted"
        ], 200);
    }
}
