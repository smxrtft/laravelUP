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
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID');
            $table->string('Username');
            $table->string('Password');
            $table->string('Email')->unique();
            $table->string('UserPhoto')->nullable();
            $table->enum('Role', ['Пользователь', 'Администратор']);
            $table->boolean('is_banned')->default(false);
            // Добавьте другие необходимые поля для профиля пользователя
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
