<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewServiceHistory extends Model
{
    protected $table = 'crewservicehistory';

    protected $primaryKey = 'ServiceId';
    
    public $timestamps = false;

    protected $fillable = [
        'CrewMemberId', 
        'ShipCode', 
        'RankId', 
        'SignOnDate', 
        'SignOffDate', 
        'EndOfContractDate'
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class, 'ShipCode', 'Code');
    }

    public function crewMember()
    {
        return $this->belongsTo(CrewMember::class, 'CrewMemberId', 'CrewMemberId');
    }

    public function rank()
    {
        return $this->belongsTo(CrewRank::class, 'RankId', 'RankId');
    }
}
