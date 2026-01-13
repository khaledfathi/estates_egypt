<?php

namespace App\Shared\Infrastructure\Models\Transaction;

use App\Models\EstateMaintenanceExpenses;
use App\Models\RentInvoice;
use App\Shared\Infrastructure\Models\SharedWaterInvoice\SharedWaterInvoice;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =[
        'date',
        'amount',
        'description',
    ];

    public function estateMaintenanceExpenses  (){
        return $this->hasMany(EstateMaintenanceExpenses::class);
    }
    public function rentInvoices ()
    {
        return $this->hasMany(RentInvoice::class);
    }
    public function sharedWaterInvoices (){
        return $this->hasMany(SharedWaterInvoice::class) ;
    }
}
