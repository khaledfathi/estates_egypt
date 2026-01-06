<?php

namespace App\Shared\Infrastructure\Models\SharedWaterInvoice;

use App\Shared\Infrastructure\Models\Transaction\Transaction;
use App\Shared\Infrastructure\Models\Unit\UnitContract;
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

    public function contract (){
        return $this->belongsTo(UnitContract::class , 'contract_id');
    }
    public function transaction (){
        return $this->belongsTo(Transaction::class , 'transaction_id');
    }
}
