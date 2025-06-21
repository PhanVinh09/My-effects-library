<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInterface extends Model
{
    protected $table = 'user_interfaces';
    public $timestamps = true;
    protected $primaryKey = 'id_UI';
    protected $fillable = [
        'author',
        'ui_name',
        'type',
        'title',
        'link',
        'html',
        'css',
        'js'
    ];
}
