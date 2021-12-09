<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
      Schema::create('posts', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->string('title',100); 
               $table->text('body');
               $table->unsignedBigInteger('user_id');
               $table->string('image_path')->nullable();
               $table->boolean('is_approved')->default(false);
               $table->unsignedInteger('apply_user')->nullable();
               $table->timestamps();
               $table->softDeletes();
            });
            
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
