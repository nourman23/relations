<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::create('authers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('nationality');
            $table->string('email');
        });
        Schema::create('Admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->text('book_title');
            $table->integer('auther_id')->unsigned();
            $table->longText('book_description');
            $table->text('book_auther');
            $table->binary('book_image');
            $table->foreign('auther_id')->references('id')->on('authers')

                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};