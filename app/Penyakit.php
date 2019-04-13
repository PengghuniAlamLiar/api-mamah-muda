<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';

    protected $primaryKey = 'penyakit_id';

    protected $connection = 'mysql_wp';
}