<?php

namespace App\Models;

use App\Shared\Infrastructure\Models\Transaction\Transaction;
use App\Shared\Infrastructure\Models\Unit\UnitContract;
use Illuminate\Database\Eloquent\Model;

class RentInvoice extends Model
{
    protected $fillable = [ 
        'contract_id',
        'transaction_id',
        'for_month',
        'for_year',
    ];

    public function transaction (){
        return $this->belongsTo(Transaction::class , 'transaction_id' );
    }
    public function contract(){
        return $this->belongsTo(UnitContract::class , 'contract_id' );
    }
}
