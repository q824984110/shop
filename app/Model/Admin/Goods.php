<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';

    protected $primaryKey = 'gid';

    public $timestamps = false;

    protected $guarded = [];

    //关联goods_img数据表
    public function gm()
    {
    	return $this->hasMany('App\Model\Admin\Goods_img','gid','gid');
    }
}
