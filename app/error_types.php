<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class error_types extends Model
{
    protected $table = 'error_types';
    protected $fillable = [
        'error_name'
    ];
}
