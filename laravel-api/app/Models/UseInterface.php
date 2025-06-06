<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseInterface extends Model
{
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
