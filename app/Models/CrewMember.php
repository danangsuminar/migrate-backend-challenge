<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    protected $table = 'crewmember';

    protected $primaryKey = 'CrewMemberId';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'CrewMemberId', 
        'FirstName', 
        'LastName', 
        'BirthDate', 
        'Nationality'
    ];

    public function serviceHistories()
    {
        return $this->hasMany(CrewServiceHistory::class, 'CrewMemberId', 'CrewMemberId');
    }
}
