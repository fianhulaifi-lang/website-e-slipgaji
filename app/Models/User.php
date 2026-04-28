<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Divisi;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'db_induk';
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'divisi'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'id');
    }
}