<?php

namespace App\Shared\Infrastructure\Models\Unit;

use App\Shared\Infrastructure\Models\Renter\Renter;
use Illuminate\Database\Eloquent\Model;

class UnitContract  extends Model
{
    protected $fillable = [
        'unit_id',
        'renter_id',
        'type',
        'rent_value',
        'annual_rent_increasement',
        'insurance_value',
        'start_date',
        'end_date',
        'water_invoice_percentage',
        'electricity_invoice_percentage',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id');
    }
}
