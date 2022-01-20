<?php


namespace TaskApp\Database\Test;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationForTest
{
    public static function createTaskTable()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('name',30);
            $table->mediumText('description');
            $table->tinyInteger('state')->default(5);
            $table->timestamps();
        });
    }

    public static function dropTaskTable()
    {
        Schema::dropIfExists('tasks');
    }

    public static function createTempTagTable()
    {
        Schema::create('temp_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('taggable_type', 32);
            $table->unsignedBigInteger('taggable_id');
            $table->index(['taggable_type', 'taggable_id']);

            $table->json('payload')->nullable();
            $table->string('title', 32)->nullable();
            $table->timestamp('expired_at')->nullable()->index();
            $table->timestamp('created_at')->nullable();

            $table->unique(['taggable_type', 'taggable_id', 'title']);
        });
    }

    public static function dropTempTagTable()
    {
        Schema::dropIfExists('temp_tags');
    }
}
