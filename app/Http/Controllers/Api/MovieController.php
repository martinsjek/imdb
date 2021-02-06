<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp;


class MovieController extends Controller
{
    public function getTopMovies()
    {
        $client = new GuzzleHttp\Client(['base_uri' => env('MY_API_FILMS_DOMAIN')]);

        $response = $client->get('/imdb/top',[
            'query' => [
                'token' =>  env('MY_API_FILMS_TOKEN')
            ]
        ]);

        return $response->getBody();
    }
}
