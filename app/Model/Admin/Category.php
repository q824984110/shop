<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'goods_type';

    protected $primaryKey = 'tid';

    public $timestamps = false;

    protected $guarded = [];
}
