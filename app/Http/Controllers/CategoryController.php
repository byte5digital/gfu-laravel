<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

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

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCategory();

        $category = new Category(request(['name']));

        $category->save();

        return redirect(route('category.index'))->with('status', 'success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $this->validateCategory();

        $category->name = request('name');
        $category->save();

        
        return redirect(route('category.show', $id))->with('status', 'Category successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          //find article with id or return 404
          $category = Category::findOrFail($id);


          //delete article from DB
          $category->delete();

        // Deletes entry in pivot table when category is soft deleted
        $category->blogEntries()->sync([]);

          //return redirect to view with status in session
          return redirect(route('category.index'))->with('status', 'Category deleted successfully.');
    }

    /**
     * validates Request 
     */
    public function validateCategory(){

        return request()->validate([
            'name' => ['required', 'string', 'min:5', 'max:50'],
        ]);
    }
}
