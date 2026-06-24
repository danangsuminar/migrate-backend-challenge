<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $table = 'ship';

    protected $primaryKey = 'Code';
    protected $keyType = 'string';
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'Code', 
        'Name', 
        'FiscalYear', 
        'Status'
    ];

    public function users()
    {
        /*
         * Perhatikan bahwa parameter ke-3 dan ke-4 POSISINYA DITUKAR 
         * dibandingkan dengan yang ada di AppUser.
         * 3. Foreign key untuk model SAAT INI yaitu Ship ('ShipCode')
         * 4. Foreign key untuk model TARGET yaitu AppUser ('UserId')
         */
        return $this->belongsToMany(AppUser::class, 'usershipassignment', 'ShipCode', 'UserId');
    }

    // Relasi One-to-Many
    public function serviceHistories()
    {
        return $this->hasMany(CrewServiceHistory::class, 'ShipCode', 'Code');
    }

    public function budgets()
    {
        return $this->hasMany(BudgetData::class, 'ShipCode', 'Code');
    }

    public function transactions()
    {
        return $this->hasMany(AccountTransaction::class, 'ShipCode', 'Code');
    }
}
