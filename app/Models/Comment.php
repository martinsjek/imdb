<?php


namespace App\Models;


use App\Rules\CommentTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    protected $fillable = [
        'movie_id',
        'name',
        'comment',
        'ip'
    ];

    public static $rules = [
        'name' => 'required|string|max:255'
    ];

    protected $visible = [
        'name',
        'comment'
    ];

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class);
    }
}
