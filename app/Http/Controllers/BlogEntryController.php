<?php

namespace App\Http\Controllers;

use App\BlogEntry;
use Auth;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use App;
use App\Contracts\BlogInterface;

class BlogEntryController extends Controller
{
    use UploadTrait;

    private $blogService;

    // BlogInterface has binding to BlogMysqlContainer -> see App\Providers\BlogProvider
    public function __construct(BlogInterface $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all categories
        $categories = Category::all();

        //creating blog entry using blogService
        $blogEntries = $this->blogService->getAllBlogEntries();

        //pass blogEntries and categories to index view
        return view('blog.index', ['blogEntries' => $blogEntries, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all categories
        $categories = Category::all();

        //pass categories to create view
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
        //validate image
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

        // build request array
        $requestArray = $request->post();

        //add filePath to request array
        $requestArray['filePath'] = $filePath;

        //create new blogEntry using BlogService
        $newBlogEntry = $this->blogService->createEntityFromArray($requestArray);

        //save new entry
        $this->blogService->saveBlogEntry($newBlogEntry);

        //if request has categories
        if (request()->has('categories')) {
            //attach categories to blog entries, meaning: add entry into blogs_categories pivot table
            $newBlogEntry->categories()->attach(request('categories'));
        }

        //redirect to route blog index
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
        //return view blog show with BlogEntry
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
        //get all categories
        $categories = Category::all();

        //get all categories attached to the blogEntry
        $attachedCategories = $blogEntry->categories()->get();

        //return view with blogEntry, categories and attached categories
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
        // set headline and content to headline and content from request
        $blogEntry->headline = $request->post('headline');
        $blogEntry->content = $request->post('content');

        //save BlogEntry with new data
        $blogEntry->save();

        // sync categories, meaning: new categories will be added to pivot table while removed categories will be removed from pivot table
        $blogEntry->categories()->sync(request('categories'));

        //redirect to route blog.index
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
        // delete blogEntry
        $blogEntry->delete();

        //redirect to route blog.index
        return response()->redirectTo(route('blog.index'));
    }

    public function indexCategorized(Category $category)
    {
        //get all categories
        $categories = Category::all();

        //get blogEntries where category = requested category
        $categorizedEntries = Category::where('id', $category->id)->firstOrFail();

        // paginate results
        $blogEntries = $categorizedEntries->blogEntries()->paginate(2);

        // return view blog.index and pass blogEntries and categories to it
        return view('blog.index', compact('blogEntries', 'categories'));
    }
}
