<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesinKayitForm extends Model
{


    use HasFactory;

    protected $guarded = [];

    public function getSinif(){
        return $this->hasOne(Siniflar::class,'id','sinif_id');
    }
}
