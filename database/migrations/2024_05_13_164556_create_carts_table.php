<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('AdID');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('AdID')->references('AdID')->on('advertisements')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}