<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class errors extends Model
{
    protected $table = 'errors';
    protected $fillable = [
        'user_id', 'error', 'description', 'type', 'created_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function error_types() {
        return $this->belongsTo('App\error_types','type','id');
    }

}
