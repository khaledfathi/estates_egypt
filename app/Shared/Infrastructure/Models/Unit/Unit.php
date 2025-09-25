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
    public function Estate(){
        return $this->belongsTo(Estate::class , 'estate_id');
    }

}
