<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Padanan dari 'int UserId' (Primary Key, Auto Increment)
            $table->string('name'); // Dari UsersController
            $table->string('username')->unique(); // Dari AuthController (Harus unik!)
            $table->string('password'); // Dari AuthController
            $table->string('role'); // Dari UsersController & AuthController
            $table->timestamps(); // Otomatis membuat kolom 'created_at' & 'updated_at'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};