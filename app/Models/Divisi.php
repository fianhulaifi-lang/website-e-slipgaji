<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $connection = 'db_induk';
    protected $table = 'divisi';

    protected $fillable = [
        'nama_divisi'
    ];
}