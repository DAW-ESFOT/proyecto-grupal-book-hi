<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function(Blueprint $table){
            $table->id();
            $table->text('title');
            $table->text('author');
            $table->text('editorial');
            $table->dateTime('year_edition');
            $table->float('price');
            $table->integer('pages');
            $table->text('synopsis');
            $table->enum('book_status',['new','used']);
            $table->string('cover_page');
            $table->string('back_cover');
            $table->enum('donation',['yes','no']);
            $table->enum('available_status',['available', 'unavailable']);
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
        Schema::dropIfExists('libros');
    }
}
