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

    public static $rules = [
        'title' => 'required|string|max:255',
        'imdb_id' => 'required|string|max:255',
        'poster' => 'required|string|max:255',
        'year' => 'required|integer',
        'rating' => 'required|numeric',
        'ranking' => 'integer'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
