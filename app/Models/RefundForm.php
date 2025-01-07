<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refundform extends Model
{

    protected $table = 'refund_forms';

    protected $fillable = ['name', 'file', 'status'];
}
