<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model
{
    protected $table = 'advertising';


    protected $primarykey ='id';


    public $timestamps = false;


    //不可被批量赋值的属性
    protected $guarded = [];
}
