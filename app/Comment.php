<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const APPROVED = 2;

    protected $table = 'comment';

    protected $primaryKey = 'comment_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_content', 'comment_status',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->where('comment_status', self::APPROVED);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'article_id', 'article_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
