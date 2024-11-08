<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCategory(){
        return $this->hasOne(Categories::class,'id','category_id');
    }

}
