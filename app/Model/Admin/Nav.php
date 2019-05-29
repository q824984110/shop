<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $table = 'nav';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
}
