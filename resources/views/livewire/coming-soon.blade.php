<div wire:init="loadComingSoon" class="most-anticipated-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        <div class="game flex">
            <a href="#"><img
                    src="{{ isset($game['cover']) ? Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) : '' }}"
                    alt="image" class="w-16 hover:opacity-75 transition ease-in-out duration-200"></a>

            <div class="ml-4">
                <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                <div class="text-gray-400 text-sm mt-1">
                    {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}</div>
            </div>
        </div>
    @empty
        @foreach (range(1, 4) as $game)

            <div class="game flex">
                <div class="bg-gray-700 w-16 h-16"></div>

                <div class="ml-4">
                    <div class="text-transparent bg-gray-700 inline-block rounded ">Title goes here</div>
                    <div class="text-transparent inline-block bg-gray-800 text-sm mt-2 rounded">Sep 2, 2021</div>
                </div>
            </div>
        @endforeach
    @endforelse


</div>
