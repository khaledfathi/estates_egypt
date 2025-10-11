<?php

namespace App\Shared\Infrastructure\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class UnitUtilityService extends Model
{
    protected $fillable = [
        'unit_id',
        'type',
        'owner_name',
        'counter_number',
        'electronic_payment_number',
        'notes'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class , 'unit_id');
    }
}
