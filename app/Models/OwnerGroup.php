<?php

namespace App\Models;

use App\Shared\Infrastructure\Models\Owner\Owner;
use App\Shared\Infrastructure\Models\Owner\OwnerInGroup;
use Illuminate\Database\Eloquent\Model;

class OwnerGroup extends Model
{
    protected $fillable = [ 'name' ];
    public function ownerInGroups (){
        return $this->hasMany(OwnerInGroup::class, 'owner_id', 'id');
    }
}

