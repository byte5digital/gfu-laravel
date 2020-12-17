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
        //get all categories
        $categories = Category::all();

        //return view with categories
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view for category.create
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
        //validate Category using validateCategory function in this Controller
        $this->validateCategory();

        // create new category using name in request
        $category = new Category(request(['name']));

        //save new category
        $category->save();

        //redirect to category.index route with status in session
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
        //get category by id, findOrFail returns 404 when category cant be found
        $category = Category::findOrFail($id);

        //return view for show with category
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
        //get category by id, findOrFail returns 404 when category cant be found
        $category = Category::findOrFail($id);

        //return view for edit with category
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
        //get category by id, findOrFail returns 404 when category cant be found
        $category = Category::findOrFail($id);

        //validate Category using validateCategory function in this Controller
        $this->validateCategory();

        //set name of category to name in request
        $category->name = request('name');
        //save category
        $category->save();

        //redirect to route category.show with status in session
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
    public function validateCategory()
    {

        //validate request using validator function
        return request()->validate([
            //name must be required, a strin, min 5 characters, max 50 characters
            'name' => ['required', 'string', 'min:5', 'max:50'],
        ]);
    }
}
