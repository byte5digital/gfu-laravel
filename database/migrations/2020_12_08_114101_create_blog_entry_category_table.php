<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogEntryCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entry_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_entry_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->unique(['blog_entry_id', 'category_id']);

            $table->foreign('blog_entry_id')->references('id')->on('blog_entries')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_entry_category');
    }
}
