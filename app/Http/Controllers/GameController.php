<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $game = Http::withHeaders(config('services.igdb'))
                ->withBody("fields name, cover.url, first_release_date, platforms.abbreviation, rating,
                slug, involved_companies.company.name, genres.name, aggregated_rating, summary, websites.*,
                videos.*, screenshots.*, similar_games.cover.url, similar_games.name, similar_games.rating,
                similar_games.platforms.abbreviation, similar_games.slug;
                    where slug = \"{$slug}\";", "text/plain")
        ->post('https://api.igdb.com/v4/games')->json();

        abort_if(!$game, 404);

        return view('show', [
            'game' => $this->formatGameForView($game[0]),
        ]);
    }

    private function formatGameForView($game)
    {
        return collect($game)->merge([
            'coverImageUrl' => Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']),
            'genres' => collect($game['genres'])->pluck('name')->implode(', '),
            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            'involved_companies' => collect($game['involved_companies'])->map(fn($company) => collect($company['company']))->pluck('name')->implode(', '),
            'memberRating' => isset($game['rating']) ? round($game['rating']).'%' : '0%',
            'criticsRating' => isset($game['aggregated_rating']) ? round($game['aggregated_rating']).'%' : '0%',
            'trailer' => isset($game['videos']) ? collect($game['videos'])->map(function($video){
                        if(in_array('Trailer', $video)){
                            return $video['video_id'];
                        }
            })->filter()->first() : null,
            'screenshots' => isset($game['screenshots']) ? collect($game['screenshots'])->map(function($screenshot){
                        return [
                            'big' => Str::replaceFirst('thumb', 'screenshot_big', $screenshot['url']),
                            'huge' => Str::replaceFirst('thumb', 'screenshot_huge', $screenshot['url']),
                        ];
            })->take(9) : null,
            'similarGames' => collect($game['similar_games'])->map(function($game){
                 return collect($game)->merge([
                    'coverImageUrl' => array_key_exists('cover', $game) ?
                                        Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) :
                                        'https://via.placeholder.com/264x352',
                    'rating' => isset($game['rating']) ? round($game['rating']) . '%' : null,
                    'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
                 ]);
            })->take(5),
            'socials' => [
                'twitter' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first(),
                'facebook' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first(),
                'instagram' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first(),
            ]
        ])->toArray();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}