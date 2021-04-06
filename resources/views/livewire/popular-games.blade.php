<div wire:init='loadPopularGames'
    class="popular-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 border-b pb-16 border-gray-800">
    @forelse ($popularGames as $game)
        <x-game-card :game="$game" />
    @empty
        @foreach (range(1, 10) as $game)
            <x-skeleton-big />
        @endforeach

    @endforelse

</div>
