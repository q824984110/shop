<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $guarded = [];
    public function um()
    {
        return $this->hasone('App\Model\Admin\UserInfo', 'uid');
    }
}
