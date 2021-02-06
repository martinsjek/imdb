<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'ip'
    ];

    public static $rules = [
        'movie_id' => 'required|exists:movies,id',
        'name' => 'required|string|max:255',
        'comment' => 'required|string',
        'ip' => 'integer'
    ];

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class);
    }
}
