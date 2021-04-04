<div wire:init='loadRecentlyReviewed' class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
            <div class="relative flex-none">
                <a href="#"><img src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="image"
                        class="w-48 hover:opacity-75 transition ease-in-out duration-200"></a>

                @if (isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                        style="right:-20px; bottom: -20px;">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($game['rating']) . '%' }} </div>
                    </div>
                @endif

            </div>
            <div class="ml-12">
                <a href="#"
                    class="block text-lg font-semi-bold leading-tight hover:text-gray-400 mt-4">{{ $game['name'] }}</a>
                <div class="text-gray-400 mt-1">
                    @foreach ($game['platforms'] as $platform)
                        {{ $platform['abbreviation'] }} &middot;
                    @endforeach
                </div>

                <p class="text-gray-400 mt-6 hidden lg:block">{{ $game['summary'] }}</p>
            </div>

        </div>

    @empty
        <div class="spinner mt-8"></div>

    @endforelse



</div>
