<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccounts extends Model
{
    protected $table = 'ChartOfAccounts';
    
    protected $primaryKey = 'AccountNumber';

    // Beri tahu Eloquent bahwa tipe PK adalah string, bukan integer
    protected $keyType = 'string';

    // Beri tahu Eloquent agar tidak melakukan auto-increment saat insert data baru
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = ['AccountNumber', 'Description', 'ParentAccountNumber', 'AccountType'];

    // Relasi ke Akun Induk (Self-Referencing)
    public function parentAccount()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'ParentAccountNumber', 'AccountNumber');
    }

    // Relasi ke Akun Anak (Self-Referencing)
    public function childAccounts()
    {
        return $this->hasMany(ChartOfAccounts::class, 'ParentAccountNumber', 'AccountNumber');
    }

    // Relasi ke Data Keuangan
    public function budgets()
    {
        return $this->hasMany(BudgetData::class, 'AccountNumber', 'AccountNumber');
    }

    public function transactions()
    {
        return $this->hasMany(AccountTransaction::class, 'AccountNumber', 'AccountNumber');
    }
}
