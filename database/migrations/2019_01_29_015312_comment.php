<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function(Blueprint $table) {
            $table->increments('comment_id');
            $table->text('comment_content');
            $table->unsignedInteger('article_id');
            $table->integer('user_id')->nullable();
            $table->foreign('article_id')
                ->references('article_id')
                ->on('article');
            $table->integer('comment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
