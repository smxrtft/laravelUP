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
        Schema::create('admin_log', function (Blueprint $table) {
            $table->id('LogID');
            $table->unsignedBigInteger('AdminID');
            $table->enum('Action', ['Добавление', 'Редактирование', 'Блокировка', 'Разблокировка']);
            $table->unsignedBigInteger('TargetUserID')->nullable();
            $table->unsignedBigInteger('TargetAdID')->nullable();
            // Добавьте другие дополнительные данные
            $table->timestamps();

            $table->foreign('AdminID')->references('UserID')->on('users');
            $table->foreign('TargetUserID')->references('UserID')->on('users');
            $table->foreign('TargetAdID')->references('AdID')->on('advertisements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_log');
    }
};
