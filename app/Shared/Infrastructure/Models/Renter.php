<?php

namespace App\Shared\Infrastructure\Models; 

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = [ 'name','identity_type','identity_number', 'notes' ] ;

    public function renterPhones (){
        return $this->hasMany( RenterPhone::class , 'renter_id' , 'id');
    }
}
