<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipHistory extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'file',
        'status'
    ];
}
