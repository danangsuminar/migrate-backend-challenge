<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Laravel\Sanctum\HasApiTokens;

class AppUser extends Authenticatable
{
    use HasApiTokens;

    // Override nama tabel bawaan (app_users) menjadi AppUser
    protected $table = 'AppUser';

    // Override primary key bawaan (id) menjadi UserId
    protected $primaryKey = 'UserId';
    
    public $incrementing = false;
    protected $keyType = 'string';

    // Matikan timestamps (created_at & updated_at)
    public $timestamps = false;

    // Tentukan kolom yang bisa diisi (Mass Assignment)
    protected $fillable = ['Name', 'Role'];

    public function ships()
    {
        /*
         * Parameter belongsToMany:
         * 1. Model target (Ship::class)
         * 2. Nama tabel pivot ('usershipassignment')
         * 3. Foreign key di tabel pivot untuk model SAAT INI ('UserId')
         * 4. Foreign key di tabel pivot untuk model TARGET ('ShipCode')
         */
        return $this->belongsToMany(Ship::class, 'usershipassignment', 'UserId', 'ShipCode');
    }
}
