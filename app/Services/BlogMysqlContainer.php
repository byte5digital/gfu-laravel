<?php

namespace App\Services;

use App\BlogEntry;
use App\Contracts\BlogInterface;
use Auth;

class BlogMysqlContainer implements BlogInterface
{

    public function createEntityFromArray(array $blogProps)
    {
        // create new BlogEntry with Model like we used to do in Controller
        $newBlogEntry = new BlogEntry();
        $newBlogEntry->headline = $blogProps['headline'];
        $newBlogEntry->content = $blogProps['content'];
        //get user_id from Auth 
        $newBlogEntry->user_id = Auth::user()->id;
        $newBlogEntry->img_url = $blogProps['filePath'];

        // return the new blogEntry
        return $newBlogEntry;
    }

    public function getAllBlogEntries()
    {
        //get blogEntries sorted by latest 'created_at' and paginate (5 entries per page)
        return BlogEntry::latest('created_at')->paginate(5);
    }

    public function getBlogEntryById(int $id)
    {
        // return Blog entry where id = requested id
        return BlogEntry::whereId($id);
        //same as BlogEntry::where('id', '=', $id);
    }

    public function getBlogEntryByUserId(int $user_id)
    {
        //return BlogEntry where user_id = requested user_id
        return BlogEntry::whereUserId($user_id);
    }

    public function saveBlogEntry(BlogEntry $blogEntry)
    {
        //save BlogEntry
        return $blogEntry->save();
    }
}
