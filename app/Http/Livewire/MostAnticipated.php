<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MostAnticipated extends Component
{

    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;
        $current = Carbon::now()->timestamp;

        $this->mostAnticipated = Cache::remember('most-anticipated', 86400, function () use($afterFourMonths, $current) {
            return Http::withHeaders(config('services.igdb'))->withBody("fields name, cover.url, first_release_date, total_rating_count, slug;
                        where platforms = (48,49,130,6)
                        & (first_release_date >= {$current}
                        & first_release_date < {$afterFourMonths});
                        limit 4;", "text/plain")
            ->post('https://api.igdb.com/v4/games')->json();
        });

    }

    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
