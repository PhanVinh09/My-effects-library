<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin_Management extends Model
{
    protected $table = 'Users';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'membership_level'
    ];
}
