<?php

namespace App\Rules;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CommentTime implements Rule
{
    public int $movie;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $commentTimeInterval = Carbon::now()->subMinutes(15);
        $ip = request()->getClientIp();

        $lastInsertedCommentByIp = Comment::select('id')
            ->where(['ip' => $ip])
            ->where(['movie_id' => $this->movie])
            ->where('updated_at', '>', $commentTimeInterval)
            ->orderBy('updated_at', 'desc')
            ->first();

        return !$lastInsertedCommentByIp;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You need to wait 15 minutes before you can comment again';
    }
}
