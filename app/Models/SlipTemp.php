<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipTemp extends Model
{
    protected $table = 'slip_temps';

    protected $fillable = [
        'nik',
        'file_slip',
        'upload_date',
        'user_id'
    ];
    
     public $timestamps = true;

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'nik', 'nik');
    }
}