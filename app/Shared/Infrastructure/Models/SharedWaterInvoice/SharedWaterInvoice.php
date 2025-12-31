<?php

namespace App\Shared\Infrastructure\Models\SharedWaterInvoice; 

use Illuminate\Database\Eloquent\Model;

class SharedWaterInvoice extends Model
{
    protected $fillable = [
        'contract_id',
        'transaction_id',
        'shared_value',
        'for_month',
        'for_year',
    ];
}
