<div class="relative" x-data="{ isVisible: true }" @click.away="isVisible = false">
    <input wire:model.debounce.300ms="search" type="text" placeholder="Search (Press '/' to focus)"
        @focus="isVisible = true" @keydown.escape.window="isVisible = false" @keydown="isVisible = true" x-ref="search"
        @keydown.window="
            if(event.keyCode == 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        class="bg-gray-800 text-sm rounded-full pl-8 px-3 w-64 focus:outline-none focus:ring-2 focus:ring-yellow-600 py-1">

    <div class="absolute top-0 flex items-center h-full ml-2">

        <svg xmlns="http://www.w3.org/2000/svg" class=" text-gray-400 w-4" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-search">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3" style="position: absolute"></div>
    @if (strlen($search) > 2)

        <div class="absolute z-50 bg-gray-800 text-xs rounded w-64 mt-2"
            x-show.transition.opacity.duration.500ms="isVisible">
            @if (count($searchResult) > 0)
                <ul>
                    @foreach ($searchResult as $game)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('game.show', $game['slug']) }}"
                                class="flex items-center transition ease-in-out duration-150 hover:bg-gray-700 px-3 py-3">
                                @if (isset($game['cover']))
                                    <img class="w-10"
                                        src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}"
                                        alt="cover">
                                @else
                                    <img class="w-10" src="https://via.placeholder.com/264x352" alt="cover">
                                @endif

                                <span class="ml-4">{{ $game['name'] }}</span>
                            </a>
                        </li>
                    @endforeach


                </ul>
            @else
                <div class="px-3 py-3">No Results for <span class="italics"> "{{ $search }}"</span></div>
            @endif
        </div>
    @endif
</div>
