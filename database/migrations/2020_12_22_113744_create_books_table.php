<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('editorial');
            $table->integer('year_edition');
            $table->float('price');
            $table->integer('pages');
            $table->text('synopsis');
            $table->string('cover_page');
            $table->string('back_cover');
            $table->timestamps();
        });
        Schema::create('book_business', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('restrict');
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('restrict');
            $table->timestamps();
            $table->boolean('available')->default(1);
            $table->boolean('new')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('book_business');
        Schema::dropIfExists('books');
        Schema::enableForeignKeyConstraints();
    }
}
