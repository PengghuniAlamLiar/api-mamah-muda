<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $table = 'solusi';

    protected $primaryKey = 'solusi_id';

    protected $connection = 'mysql_wp';

    public function posts()
    {
        return $this->hasMany('App\Post', 'post_author', 'ID');
    }
}