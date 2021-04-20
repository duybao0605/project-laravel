<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';
    protected $fillable =['name','image','price','category','brand','status','sale','company','detail'];

    public $timestamps = true;
}
