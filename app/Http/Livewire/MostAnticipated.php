<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MostAnticipated extends Component
{

    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $mostAnticipated = Cache::remember('most-anticipated', 86400, function () use($afterFourMonths, $current) {
            return Http::withHeaders(config('services.igdb'))->withBody("fields name, cover.url, first_release_date, total_rating_count, slug;
                        where platforms = (48,49,130,6)
                        & (first_release_date >= {$current}
                        & first_release_date < {$afterFourMonths});
                        limit 4;", "text/plain")
            ->post('https://api.igdb.com/v4/games')->json();
        });

        $this->mostAnticipated = $this->formatForView($mostAnticipated);

    }

    private function formatForView($game)
    {
        return collect($game)->map(function($game){
            return collect($game)->merge([
                'coverImageUrl' => Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']),
                'releaseDate' => Carbon::parse($game['first_release_date'])->format('M d, Y'),

            ]);
        })->toArray();

    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
