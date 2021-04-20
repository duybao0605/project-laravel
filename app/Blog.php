<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
   	protected $table = 'blog';
    protected $fillable =['title','image','description','content'];

    public $timestamps = false;
}
