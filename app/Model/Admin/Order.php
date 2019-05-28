<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';


    protected $primarykey = 'id';


    public $timestamps = false;


    //不可被批量赋值的属性
    protected $guarded = [];
}


       