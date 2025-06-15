<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseInterface extends Model
{
    protected $table = 'use_interfaces';
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
