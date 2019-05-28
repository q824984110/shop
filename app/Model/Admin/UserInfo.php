<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';

    protected $primaryKey = 'uid';

    public $timestamps = false;

    protected $guarded = [];
   
}
