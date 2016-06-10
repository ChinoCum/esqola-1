<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_attribute extends Model
{
    protected $table = "user_attributes";
    protected $fillable = ['user_id', 'grade', 'incharge', 'incharge_info', 'avatar'];

}
