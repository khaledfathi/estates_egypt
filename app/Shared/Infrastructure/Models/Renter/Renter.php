<?php

namespace App\Shared\Infrastructure\Models\Renter;

use App\Shared\Infrastructure\Models\Unit\UnitContract;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    protected $fillable = [ 'name','identity_type','identity_number', 'notes' ] ;

    public function phones (){
        return $this->hasMany( RenterPhone::class , 'renter_id' , 'id');
    }
    public function unitContracts (){
        return $this->hasMany(UnitContract::class , 'unit_id', 'id');
    }
}
