<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlipHistory extends Model
{
    protected $connection = 'mysql'; // WAJIB
    
    protected $fillable = [
        'nama',
        'email',
        'divisi_id',
        'file',
        'status'
    ];
      public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
