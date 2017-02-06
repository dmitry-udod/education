<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('html');
            $table->boolean('is_published');
            $table->dateTime('publish_at')->nullable();
            $table->integer('created_by')->unsidned();
            $table->timestamps();
        });

        // Create table for associating articles to roles
        Schema::create('article_role', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('role_id')->unsigned();
        });

        // Create table for associating articles to categories
        Schema::create('article_category', function (Blueprint $table) {
            $table->integer('article_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_category');
        Schema::dropIfExists('article_role');
        Schema::dropIfExists('articles');
    }
}
