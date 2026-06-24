<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    protected $table = 'accounttransaction';

    protected $primaryKey = 'TransactionId';
    
    public $timestamps = false;

    protected $fillable = [
        'ShipCode', 
        'AccountNumber', 
        'AccountPeriod', 
        'ActualValue'
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
