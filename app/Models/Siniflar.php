<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniflar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCourses(){
        return $this->hasOne(Courses::class,'id','egitim_id');
    }
}
