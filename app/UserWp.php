<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWp extends Model
{
    protected $table = 'mm_users';

    protected $primaryKey = 'ID';

    protected $connection = 'mysql_wp';

    public function posts()
    {
        return $this->hasMany('App\Post', 'post_author', 'ID');
    }
}