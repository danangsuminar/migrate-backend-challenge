<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Kita butuh ini untuk API Token!

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Menentukan kolom apa saja yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'Name',
        'Role',
        'username',
        'password',
    ];

    // Menentukan kolom apa yang HARUS DIKECUALIKAN saat model diubah jadi JSON
    protected $hidden = [
        'password',
    ];

    // Mengamankan password agar otomatis di-hash saat disimpan
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}