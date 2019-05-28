<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods_img extends Model
{
    protected $table = 'goods_img';

    protected $primaryKey = 'info_id';

    public $timestamps = false;

    protected $guarded = [];
}
