<?php

namespace App\Contracts;

use App\BlogEntry;

// Repository Pattern

interface BlogInterface
{
    public function createEntityFromArray(array $blogProps);
    public function getAllBlogEntries();
    public function getBlogEntryById(int $id);
    public function getBlogEntryByUserId(int $user_id);
    public function saveBlogEntry(BlogEntry $blogEntry);
}
