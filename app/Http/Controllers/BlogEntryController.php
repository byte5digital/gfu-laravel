<?php

namespace App\Http\Controllers;

use App\BlogEntry;
use Auth;
use Illuminate\Http\Request;
use App\Category;

class BlogEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogEntries = BlogEntry::all();
        return view('blog.index', ['blogEntries' => $blogEntries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $newBlogEntry = new BlogEntry();
        $newBlogEntry->headline = $request->post('headline');
        $newBlogEntry->content = $request->post('content');
        $newBlogEntry->user_id = $user->id;
        $newBlogEntry->save();

        if(request()->has('categories')){
            $newBlogEntry->categories()->attach(request('categories'));
        }



        return response()->redirectTo(route('blog.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BlogEntry $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function show(BlogEntry $blogEntry)
    {
        return view('blog.show', ['blogEntry' => $blogEntry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogEntry $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogEntry $blogEntry)
    {
        return view('blog.edit', ['blogEntry' => $blogEntry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\BlogEntry           $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogEntry $blogEntry)
    {
        $blogEntry->headline = $request->post('headline');
        $blogEntry->content = $request->post('content');
        $blogEntry->save();
        return response()->redirectTo(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogEntry $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogEntry $blogEntry)
    {
        $blogEntry->delete();
        return response()->redirectTo(route('blog.index'));
    }
}
