<?php

namespace App\Shared\Infrastructure\Models\Unit;

use App\Shared\Infrastructure\Models\Estate\Estate;
use App\Shared\Infrastructure\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Model;

class UnitOwnership extends Model
{
    protected $fillable = [
        'unit_id',
        'owner_id',
    ];
    public function unit (){
        return $this->belongsTo(Unit::class , 'unit_id');
    }
    public function owner(){
        return $this->belongsTo(Owner::class , 'owner_id');
    }
}

