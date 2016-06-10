<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_grade extends Model
{

    protected $table = 'rltn_user_grade';
    protected $fillable = [
        'user_id',
        'grade_id'
    ];

    public function User() {
        return $this->belongsTo('App\User');
    }

}
