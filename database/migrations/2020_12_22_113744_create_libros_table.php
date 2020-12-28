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
            $table->char('book_status');
            $table->string('cover_page');
            $table->string('back_cover');
            $table->char('donation');
            $table->char('available_status');
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
