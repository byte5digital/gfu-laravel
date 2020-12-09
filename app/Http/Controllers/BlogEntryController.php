<?php

namespace App\Http\Controllers;

use App\BlogEntry;
use Auth;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
class BlogEntryController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $blogEntries = BlogEntry::latest('created_at')->paginate(2);
        return view('blog.index', ['blogEntries' => $blogEntries, 'categories' => $categories]);
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

        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Get image file
        $image = $request->file('img');

        // Make a image name based on headline and current timestamp
        $name = Str::slug($request->post('headline')) . '_' . time();

        // Define folder path
        $folder = '/img/';

        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();

        // Upload image
        $this->uploadOne($image, $folder, 'public', $name);

        $user = Auth::user();
        $newBlogEntry = new BlogEntry();
        $newBlogEntry->headline = $request->post('headline');
        $newBlogEntry->content = $request->post('content');
        $newBlogEntry->user_id = $user->id;
        $newBlogEntry->img_url = $filePath;
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
        $categories = Category::all();
        $attachedCategories = $blogEntry->categories()->get();
        return view('blog.edit', ['blogEntry' => $blogEntry, 'categories' => $categories, 'attachedCategories' => $attachedCategories]);
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

        $blogEntry->categories()->sync(request('categories'));
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

    public function indexCategorized(Category $category){

        $categories = Category::all();

        $categorizedEntries = Category::where('id', $category->id)->firstOrFail();

        $blogEntries = $categorizedEntries->blogEntries()->paginate(2);

        return view('blog.index', compact('blogEntries', 'categories'));
    }
}
