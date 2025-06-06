<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'author',
        'form_name',
        'type',
        'title',
        'link',
        'html',
        'css',
        'js'
    ];
}
