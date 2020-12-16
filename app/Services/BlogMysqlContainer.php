<?php

namespace App\Services;

use App\BlogEntry;
use App\Contracts\BlogInterface;
use Auth;

class BlogMysqlContainer implements BlogInterface
{

    public function createEntityFromArray(array $blogProps)
    {
        $newBlogEntry = new BlogEntry();
        $newBlogEntry->headline = $blogProps['headline'];
        $newBlogEntry->content = $blogProps['content'];
        $newBlogEntry->user_id = Auth::user()->id;
        $newBlogEntry->img_url = $blogProps['filePath'];

        return $newBlogEntry;
    }

    public function getAllBlogEntries()
    {
        return BlogEntry::all();
    }

    public function getBlogEntryById(int $id)
    {
        // BlogEntry::where('id', '=', $id);
        return BlogEntry::whereId($id);
    }

    public function getBlogEntryByUserId(int $user_id)
    {
        return BlogEntry::whereUserId($user_id);
    }

    public function saveBlogEntry(BlogEntry $blogEntry)
    {
        return $blogEntry->save();
    }
}
