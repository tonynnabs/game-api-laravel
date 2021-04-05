<div wire:init='loadPopularGames'
    class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 border-b pb-16 border-gray-800">
    @forelse ($popularGames as $game)

        <div class="game mt-8">
            <div class="relative inline-block">
                <a href="{{ route('game.show', $game['slug']) }}"><img
                        src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}" alt="image"
                        class="hover:opacity-75 transition ease-in-out duration-200"></a>
                @if (isset($game['rating']))
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full"
                        style="right:-20px; bottom: -20px;">
                        <div class="font-semibold text-xs flex justify-center items-center h-full">
                            {{ round($game['rating']) . '%' }} </div>
                    </div>
                @endif

            </div>
            <a href="{{ route('game.show', $game['slug']) }}"
                class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">{{ $game['name'] }}</a>
            <div class="text-gray-400 mt-1">
                @foreach ($game['platforms'] as $platform)
                    {{ $platform['abbreviation'] }} &middot;
                @endforeach
            </div>

        </div>
    @empty
        @foreach (range(1, 10) as $game)

            <div class="game mt-8">
                <div class="relative inline-block">
                    <div class="bg-gray-800 w-48 h-56"></div>

                </div>
                <div class="rounded inline-block text-transparent text-lg bg-gray-700 leading-tight mt-3">Title goes here
                </div>
                <div class=" rounded text-transparent bg-gray-700 inline-block mt-3">PS4, PC, Switch</div>

            </div>
        @endforeach

    @endforelse

</div>
