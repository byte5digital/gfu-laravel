<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    //categories can soft delete
    use SoftDeletes;

    //field name is fillable
    protected $fillable = ['name'];

    // relationship call with BlogArticle
    public function blogEntries(){

        // this (one category) belongs to many blog entries
        return $this->belongsToMany('App\BlogEntry')->withTimestamps();
    }
}
