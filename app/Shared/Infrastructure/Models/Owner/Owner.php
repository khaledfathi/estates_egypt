<?php
declare (strict_types= 1);
namespace App\Shared\Infrastructure\Models\Owner;

use App\Shared\Infrastructure\Models\Unit\UnitOwnership;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //
    protected $fillable = [
        "name",
        "national_id",
        "address",
        "notes",
    ];

    public function phones(){
        return $this->hasMany(OwnerPhone::class, 'owner_id', 'id');
    }   
    public function unitOwnerships (){
        return $this->hasMany(UnitOwnership::class);
    }

    public function ownerInGroups (){
        return $this->hasMany(OwnerInGroup::class, 'owner_id', 'id');
    }
}

