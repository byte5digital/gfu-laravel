<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogEntryResource;
use Illuminate\Http\Request;
use App\BlogEntry;
use Validator;

class BlogEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // returns entries mapped 
        // return BlogEntryResource::collection(BlogEntry::all());


        // returns entries from DB
        $entries = BlogEntry::all();
        return response()->json($entries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          //$data = $request->all();
          $data = json_decode($request->getContent(), true);
          $rules = [
              'headline' => 'required', 
              'content' => 'required',
              'img_url' => 'required',
              'user_id' => 'required',
          ];
  
          $validator = Validator::make($data, $rules);
          if ($validator->passes()) {
              
        // this attempt needs fillable in BlogEntry model
        $blogEntry = BlogEntry::create([
            'headline' => $request->headline,
            'content' => $request->content,
            'img_url' => $request->img_url,
            'user_id' => $request->user_id,
        ]);

        // this attempt doesn't need fillable in BlogEntry model
        // $blogEntry = new BlogEntry();
        // $blogEntry->headline = $request->headline;
        // $blogEntry->content = $request->content;
        // $blogEntry->user_id = 1;
        // $blogEntry->img_url= '/img/image-2_1607505758.png';
        // $blogEntry->save();

        // returns json with blog entry as in DB
        return response()->json([
            "message" => "successful created",
            "entry" => $blogEntry
        ], 200);

        // returns blog entry resource
        // return new BlogEntryResource($blogEntry);
          } else {
           
              return response()->json([
                "errors" => $validator->errors()->all()
            ], 422);
          }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BlogEntry $blogEntry)
    {
        // returns entry mapped 
        return new BlogEntryResource($blogEntry);

        // returns entrie from DB
        // $entry = BlogEntry::find($blogEntry);
        // return response()->json($entry);
    }

    
    /**
      * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * version with id
     */
    // public function update(Request $request, $id)
    // {
    //     $blogEntry = BlogEntry::findOrFail($id);
    //     $blogEntry->headline = request('headline');
    //     $blogEntry->save();

    //     return new BlogEntryResource($blogEntry);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BlogEntry  $blogEntry
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, BlogEntry $blogEntry)
    {
        // fillable in BlogEntry Model needed for this attempt
        $blogEntry->update($request->only(['headline', 'content']));

        return new BlogEntryResource($blogEntry);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogEntry $blogEntry)
    {
        $blogEntry->delete();
        return response()->json([
            "message" => "successfully deleted"
        ], 200);
    }

}
