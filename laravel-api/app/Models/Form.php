<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'Forms';
    public $timestamps = true;
    protected $primaryKey = 'id_form';
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
