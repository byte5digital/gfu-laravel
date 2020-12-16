<?php

namespace App\Services;

use App\Contracts\BlogInterface;

class BlogStubContainer implements BlogInterface
{
    public function getAllBlogEntries()
    {
        return [];
    }

    public function getBlogEntryById($id)
    {
    }

    public function getBlogEntryByUserId($id)
    {
    }

    public function saveBlogEntry($blogEntry)
    {
    }
}
