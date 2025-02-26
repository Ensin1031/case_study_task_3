<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('title');
            $table->integer('view_count')->default(0);
            $table->longText('description');
            $table->boolean('is_public')->default(false);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id')->nullable();

            $table->index('user_id', 'post_user_idx');
            $table->index('post_id', 'parent_post_idx');

            $table->foreign('user_id', 'post_user_fk')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id', 'parent_post_fk')->references('id')->on('posts')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('posts');
        }
    }
};
