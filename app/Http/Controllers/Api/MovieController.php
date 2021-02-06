<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;


class MovieController extends Controller
{
    public function getTopMovies()
    {
        return Movie::whereNotNull('ranking')->orderBy('ranking', 'asc')->get()->toArray();
    }

    public function getMovie($id)
    {
        return Movie::where(['id' => $id])->first()->toArray();
    }
}
