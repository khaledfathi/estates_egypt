<?php

namespace App\Shared\Infrastructure\Models\Renter; 

use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = [ 'name','identity_type','identity_number', 'notes' ] ;

    public function phones (){
        return $this->hasMany( RenterPhone::class , 'renter_id' , 'id');
    }
}
