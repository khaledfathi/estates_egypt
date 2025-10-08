<?php

namespace App\Shared\Infrastructure\Models\Estate; 

use Illuminate\Database\Eloquent\Model;

class EstateUtilityService extends Model
{
    protected $fillable =[
        'estate_id',
        'type',
        'owner_name',
        'counter_number',
        'electronic_payment_number',
        'notes'
    ];

    public function estate(){
        return $this->belongsTo(Estate::class , 'estate_id');
    }
}
