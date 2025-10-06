<?php

namespace App\Shared\Infrastructure\Models\Estate; 

use Illuminate\Database\Eloquent\Model;

class EstateDocument extends Model
{
    protected $fillable =[
        'estate_id',
        'title',
        'description',
        'file'
    ];

    public function estate(){
        return $this->belongsTo(Estate::class);
    }
}
