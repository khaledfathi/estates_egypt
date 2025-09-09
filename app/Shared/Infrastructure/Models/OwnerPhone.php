<?php
declare (strict_types= 1);
namespace App\Shared\Infrastructure\Models; 

use App\Shared\Infrastructure\Models\Owner;
use Illuminate\Database\Eloquent\Model;

class OwnerPhone extends Model
{
    protected $fillable = [
        'owner_id',
        'phone',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }
}
