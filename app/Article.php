<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const ACTIVE = 1;
    const GIZI = 1;
    const ARTIKEL = 2;
    const PENYAKIT = 3;

    protected $table = 'article';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('article_status', self::ACTIVE);
    }

    public function scopeGizi($query)
    {
        return $query->where('category_id', self::GIZI);
    }

    public function scopePenyakit($query)
    {
        return $query->where('category_id', self::PENYAKIT);
    }
}