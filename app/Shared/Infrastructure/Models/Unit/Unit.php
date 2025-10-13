<?php

namespace App\Shared\Infrastructure\Models\Unit;

use App\Shared\Infrastructure\Models\Estate\Estate;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'estate_id',
        'number',
        'floor_number',
        'ownership_type',
        'type',
        'is_empty'
    ];
    public function estate(){
        return $this->belongsTo(Estate::class , 'estate_id');
    }
    public function unitUtilityServices(){
        return $this->hasMany(UnitUtilityService::class );
    }
    public function unitOwnerships (){
        return $this->hasMany(UnitOwnership::class );
    }

}
