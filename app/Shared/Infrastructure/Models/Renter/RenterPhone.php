<?php

namespace App\Shared\Infrastructure\Models\Renter; 

use Illuminate\Database\Eloquent\Model;

class RenterPhone extends Model
{
    protected $fillable = [
        'phone', 'renter_id'
    ];

    public function renter (){
        return $this->belongsTo(Renter::class, 'renter_id' , 'id');
    }
}
