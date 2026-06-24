<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ubah menjadi true agar semua orang (termasuk yang belum login) bisa mengirim request ini
        return true; 
    }

    public function rules(): array
    {
        return [
            // Memastikan input username dan password wajib diisi dan berupa teks
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}