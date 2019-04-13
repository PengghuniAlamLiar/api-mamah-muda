<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';

    protected $primaryKey = 'gejala_id';

    protected $connection = 'mysql_wp';

    public function posts()
    {
        return $this->hasMany('App\Post', 'post_author', 'ID');
    }
}