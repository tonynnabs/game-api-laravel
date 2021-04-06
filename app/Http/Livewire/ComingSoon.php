<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ComingSoon extends Component
{
    public $comingSoon= [];

    public function loadComingSoon()
    {
        $current = Carbon::now()->timestamp;

        $comingSoon = Cache::remember('most-anticipated', 86400, function () use($current) {
            return Http::withHeaders(config('services.igdb'))->withBody("fields name, cover.url, first_release_date, total_rating_count, slug;
                    where platforms = (48,49,130,6)
                    & (first_release_date >= {$current});
                    sort first_release_date asc;
                    limit 4;", "text/plain")
            ->post('https://api.igdb.com/v4/games')->json();
        });


        $this->comingSoon = $this->formatForView($comingSoon);

    }

    private function formatForView($game)
    {
        return collect($game)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : null,
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y'),

            ]);
        })->toArray();

    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}