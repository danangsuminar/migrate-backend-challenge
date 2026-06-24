<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan nama tabelnya sesuai dengan nama legacy-mu (AppUser)
        Schema::table('AppUser', function (Blueprint $table) {
            // Kita set nullable() dulu agar ratusan data kru yang sudah ada tidak error saat kolom ini ditambahkan
            $table->string('username')->nullable()->unique()->after('Name'); 
            $table->string('password')->nullable()->after('username');
        });
    }

    public function down(): void
    {
        Schema::table('AppUser', function (Blueprint $table) {
            $table->dropColumn(['username', 'password']);
        });
    }
};