<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const PUSBLISH = 'publish';

    protected $table = 'mm_posts';

    protected $connection = 'mysql_wp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'post_author', 'post_date', 'post_content'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublish($query)
    {
        return $query->where('post_status', self::PUSBLISH);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\UserWp', 'post_author', 'ID');
    }

    public function term_relationship()
    {
        return $this->hasOne('App\TermRelationship', 'object_id', 'object_id');
    }
}