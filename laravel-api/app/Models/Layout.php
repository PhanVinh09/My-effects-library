<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $table = 'Layouts';
    public $timestamps = true;
    protected $primaryKey = 'id_layout';
    protected $fillable = [
        'author',
        'layout_name',
        'type',
        'title',
        'link',
        'html',
        'css',
        'js'
    ];
}
