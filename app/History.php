<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable =['email','phone','name','id_user','price'];

    public $timestamps = true;
}
