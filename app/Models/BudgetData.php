<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetData extends Model
{
    protected $table = 'budgetdata';

    protected $primaryKey = 'BudgetId';
    
    public $timestamps = false;

    protected $fillable = [
        'ShipCode', 
        'AccountNumber', 
        'AccountPeriod', 
        'BudgetValue'
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ShipCode', 'Code');
    }

    public function account()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'AccountNumber', 'AccountNumber');
    }
}
