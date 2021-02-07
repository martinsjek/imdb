<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Rules\CommentTime;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function getTopMovies(Request $request): array
    {
        $requestData = $request->all();
        $page = $requestData['page'] ?? 1;

        $moviesData = Movie::whereNotNull('ranking')->orderBy('ranking', 'asc')->paginate(20, ['*'], 'page', $page);
        $movies = [];
        foreach ($moviesData as $movie){
            $movies[] = [
                'movie' => $movie->toArray(),
                'comments' => $movie->comments->count()
            ];
        }

        return [
            'movies' => $movies,
            'currentPage' => $moviesData->currentPage(),
            'lastPage' => $moviesData->lastPage()
        ];
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
            'comment' => ['required','string', new CommentTime($movie->id)]
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
