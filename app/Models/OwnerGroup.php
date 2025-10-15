<?php

namespace App\Models;

use App\Shared\Infrastructure\Models\Owner\Owner;
use Illuminate\Database\Eloquent\Model;

class OwnerGroup extends Model
{
    protected $fillable = [ 'name' ];

    public function owners (){
        return $this->hasMany(Owner::class);
    }
}

