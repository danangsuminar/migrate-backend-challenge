<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrewRank extends Model
{
    protected $table = 'CrewRank';
    
    protected $primaryKey = 'RankId';
    
    public $timestamps = false;

    protected $fillable = ['RankName', 'Description'];

    public function serviceHistories()
    {
        return $this->hasMany(CrewServiceHistory::class, 'RankId', 'RankId');
    }
}
