<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;
use GuzzleHttp;

class GetTopMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:top';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get top IMDB movies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \JsonException
     */
    public function handle()
    {
        $client = new GuzzleHttp\Client(['base_uri' => env('MY_API_FILMS_DOMAIN')]);

        $response = $client->get('/imdb/top', [
            'query' => [
                'token' => env('MY_API_FILMS_TOKEN')
            ]
        ]);

        $movieData = $response->getBody();
        $movieData = $movieData ? json_decode($movieData, true, 512, JSON_THROW_ON_ERROR) : null;
        $movieData = $movieData['data']['movies'] ?? null;


        if ($movieData) {
            //remove existing ranking
            Movie::whereNotNull('ranking')
                ->update([
                    'ranking' => null
                ]);

            //add top ten movies
            foreach ($movieData as $movie) {
                Movie::updateOrCreate([
                    'imdb_id' => $movie['idIMDB']
                ],
                    [
                        'title' => $movie['title'],
                        'poster' => $movie['urlPoster'],
                        'year' => $movie['year'],
                        'rating' => $movie['rating'],
                        'ranking' => $movie['ranking']
                    ]);
            }
        }
    }
}
