<?php

namespace App\Shared\Infrastructure\Models\Owner;

use App\Models\OwnerGroup;
use Illuminate\Database\Eloquent\Model;

class OwnerInGroup extends Model
{
    protected $table = 'owner_in_group';
    protected $fillable = [
        'owner_id',
        'group_id',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class , 'owner_id');
    }
    public function group(){
        return $this->belongsTo(OwnerGroup::class , 'group_id');
    }
}
