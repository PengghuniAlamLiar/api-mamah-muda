<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    protected $table = 'mm_term_relationships';

    protected $primaryKey = 'ID';

    protected $connection = 'mysql_wp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    public function post() {
        return $this->belongsTo('App\Post', 'object_id', 'ID');
    }
}