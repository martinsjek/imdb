<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Rules\CommentTime;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function getTopMovies(Request $request)
    {
        $requestData = $request->all();
        $page = $requestData['page'] ?? 1;

        return Movie::whereNotNull('ranking')->orderBy('ranking', 'asc')->paginate(20, ['*'], 'page', $page)->toArray();
    }

    public function getMovie(Movie $movie): array
    {
        return [
            'movie' => $movie->toArray(),
            'comments' => $movie->comments->toArray()
        ];
    }

    public function postComment(Request $request, Movie $movie): array
    {
        $rules = Comment::$rules;
        $newRules = [
            'comment' => ['required','string', new CommentTime]
        ];
        $rules = array_merge($rules, $newRules);
        $request->validate($rules);

        $requestData = $request->all();
        $ip = $request->getClientIp();

        Comment::create([
            'movie_id' => $movie->id,
            'name' => $requestData['name'],
            'comment' => $requestData['comment'],
            'ip' => $ip
        ]);

        return [
            'comments' => $movie->comments->toArray()
        ];
    }
}
