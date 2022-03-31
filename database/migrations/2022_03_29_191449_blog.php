<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)->create('articles', function (Blueprint $table) {
            $table->unique('slug');
            $table->timestamps();
        });

        Schema::connection($this->connection)->create('tags', function (Blueprint $table) {
            $table->unique('slug');
            $table->timestamps();
        });

        Schema::connection($this->connection)->create('categories', function (Blueprint $table) {
            $table->unique('slug');
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
        Schema::connection($this->connection)->drop('articles');
        Schema::connection($this->connection)->drop('tags');
        Schema::connection($this->connection)->drop('categories');
    }
}
