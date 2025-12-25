<?php

namespace App\Shared\Infrastructure\Models\Transaction;

use App\Models\EstateMaintenanceExpenses;
use App\Models\RentInvoice;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =[
        'date',
        'amount',
        'description',
    ];

    public function EstateMaintenanceExpenses  (){
        return $this->hasMany(EstateMaintenanceExpenses::class);
    }
    public function rentInvoices ()
    {
        return $this->hasMany(RentInvoice::class);
    }
}
