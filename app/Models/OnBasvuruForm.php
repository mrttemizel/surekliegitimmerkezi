<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBasvuruForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname', 
        'email',
        'phone',
        'kvkk',
        'electronic',
        'explicit',
        'kurs_id',
        'kurs_adi'
    ];
}
