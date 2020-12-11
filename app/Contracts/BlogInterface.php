<?php

namespace App\Contracts;

// Repository Pattern

interface BlogInterface
{
    public function getAllBlogEntries();
    public function getBlogEntryById($id);
    public function getBlogEntryByUserId($id);
    public function saveBlogEntry($blogEntry);
}
