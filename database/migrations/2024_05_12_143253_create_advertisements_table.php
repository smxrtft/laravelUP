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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id('AdID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('CategoryID');
            $table->string('Title');
            $table->text('Description');
            $table->string('AdPhoto')->nullable();
            $table->enum('Status', ['Одобрено', 'Отклонено', 'На рассмотрении']);
            // Добавьте другие поля, связанные с объявлением
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users');
            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
