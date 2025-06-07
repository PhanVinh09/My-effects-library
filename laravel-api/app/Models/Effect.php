<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Effect extends Model
{
    protected $table = 'Effects';
    public $timestamps = true;
    protected $primaryKey = 'id_effect';
    protected $fillable = [
        'author',
        'effect_name',
        'type',
        'title',
        'link',
        'html',
        'css',
        'js'
    ];
}
