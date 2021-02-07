<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    public function getTopMovies(Request $request)
    {
        $requestData = $request->all();
        $page = $requestData['page'] ?? 1;

        return Movie::whereNotNull('ranking')->orderBy('ranking', 'asc')->paginate(20, ['*'], 'page', $page)->toArray();
    }

    public function getMovie($id)
    {
        return Movie::where(['id' => $id])->first()->toArray();
    }
}
