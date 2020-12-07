<?php

namespace App\Http\Controllers;

use App\BlogEntry;
use Auth;
use Illuminate\Http\Request;

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
        return view('blog.create');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BlogEntry $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogEntry $blogEntry)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogEntry $blogEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogEntry $blogEntry)
    {
        //
    }
}
