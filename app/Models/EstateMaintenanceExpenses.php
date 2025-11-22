<?php

namespace App\Models;

use App\Shared\Infrastructure\Models\Estate\Estate;
use App\Shared\Infrastructure\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;

class EstateMaintenanceExpenses extends Model
{
    protected $fillable = [ 
        'transaction_id' , 'estate_id','title' ,'description'
    ];

    public function estate (){
        return $this->belongsTo(Estate::class, 'estate_id');
    }
    public function transaction (){
        return $this->belongsTo(Transaction::class , 'transaction_id');
    }
}
