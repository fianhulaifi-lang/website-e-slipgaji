<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Divisi;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mysql'; // WAJIB
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;

}