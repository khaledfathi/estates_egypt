<?php

namespace App\Shared\Infrastructure\Models\SharedWaterInvoice;

use App\Shared\Infrastructure\Models\Estate\EstateUtilityServiceInvoice;
use App\Shared\Infrastructure\Models\Transaction\Transaction;
use App\Shared\Infrastructure\Models\Unit\UnitContract;
use Illuminate\Database\Eloquent\Model;

class SharedWaterInvoice extends Model
{
    protected $fillable = [
        'contract_id',
        'utility_service_invoice_id',
        'transaction_id',
        'shared_value',
        'for_month',
        'for_year',
    ];

    public function contract (){
        return $this->belongsTo(UnitContract::class , 'contract_id');
    }
    public function transaction (){
        return $this->belongsTo(Transaction::class , 'transaction_id');
    }

    public function utilityServiceInvoice (){
        return $this->belongsTo(EstateUtilityServiceInvoice::class, 'utility_service_invoice_id');
    }
}
