<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function courseCount()
    {
        return $this->hasMany('App\Models\Courses', 'category_id', 'id')->count();
    }


}
