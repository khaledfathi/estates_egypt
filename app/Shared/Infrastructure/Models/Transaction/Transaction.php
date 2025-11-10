<?php

namespace App\Shared\Infrastructure\Models\Transaction; 

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =[
        'date',
        'amount',
        'description',
    ];
}
