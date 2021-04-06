<div class="game flex">
    <a href="{{ route('game.show', $game['slug']) }}"><img src="{{ $game['coverImageUrl'] }}" alt="image"
            class="w-16 hover:opacity-75 transition ease-in-out duration-200"></a>

    <div class="ml-4">
        <a href="{{ route('game.show', $game['slug']) }}" class="hover:text-gray-300">{{ $game['name'] }}</a>
        <div class="text-gray-400 text-sm mt-1">
            {{ $game['releaseDate'] }}</div>
    </div>
</div>
