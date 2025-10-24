<?php

namespace App\Shared\Infrastructure\Models\Estate; 

use Illuminate\Database\Eloquent\Model;

class EstateUtilityServiceInvoice extends Model
{
    protected $fillable = [
        'estate_utility_service_id',
        'for_month',
        'for_year',
        'amount',
        'file',
    ];

    public function estateUtilityService (){
        return $this->belongsTo(EstateUtilityService::class, 'estate_utility_service_id', 'id');
    }
}
