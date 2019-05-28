<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    protected $table = 'admin';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];

    public function user_role()
    {
        return $this->belongsToMany('App\Model\Admin\Role','user_role', 'userid', 'roleid');
    }
}
