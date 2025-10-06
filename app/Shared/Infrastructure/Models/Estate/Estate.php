<?php

namespace App\Shared\Infrastructure\Models\Estate;

use App\Shared\Infrastructure\Models\Unit\Unit;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable= [
        'name',
        'address',
        'floor_count'
    ];

    public function units() {
        return $this->hasMany(Unit::class );
    }
    public function documents(){
        return $this->hasMany(EstateDocument::class);
    }
}
