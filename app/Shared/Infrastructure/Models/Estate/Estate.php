<?php

namespace App\Shared\Infrastructure\Models\Estate;

use App\Models\EstateMaintenanceExpenses;
use App\Shared\Infrastructure\Models\Unit\Unit;
use App\Shared\Infrastructure\Models\Unit\UnitOwnership;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable= [
        'name',
        'address',
        'floor_count'
    ];

    public function units() {
        return $this->hasMany(Unit::class );
    }
    public function documents(){
        return $this->hasMany(EstateDocument::class);
    }

    public function utilityServices (){
        return $this->hasMany(EstateUtilityService::class);
    }
    public function estateUtilityServiceInvoices (){
        return $this->hasMany(EstateUtilityServiceInvoice::class);
    }
    public function EstateMaintenanceExpenses  (){
        return $this->hasMany(EstateMaintenanceExpenses::class);
    }
}
