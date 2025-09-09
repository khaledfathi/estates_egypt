<?php
declare (strict_types= 1);
namespace App\Shared\Infrastructure\Models; 

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name','value'
    ];
}
