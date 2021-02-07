<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'imdb_id',
        'title',
        'year',
        'rating',
        'poster',
        'ranking'
    ];

    protected $visible = [
        'id',
        'title',
        'poster',
        'year',
        'rating',
        'ranking'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('updated_at', 'desc');
    }
}
