<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    // relationship call with BlogArticle
    public function blogEntries(){

        // this (one category) belongs to many blog entries
        return $this->belongsToMany('App\BlogEntry');
    }
}
