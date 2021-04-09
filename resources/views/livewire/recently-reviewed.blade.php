<div wire:init='loadRecentlyReviewed' class="recently-reviewed-container space-y-12 mt-8">
    @forelse ($recentlyReviewed as $game)
        <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
            <div class="relative flex-none">
                <a href="{{ route('game.show', $game['slug']) }}"><img src="{{ $game['coverImageUrl'] }}" alt="image"
                        class="w-48 hover:opacity-75 transition ease-in-out duration-200"></a>

                @if (isset($game['rating']))
                    <div id="review_{{ $game['slug'] }}"
                        class="absolute bottom-0 right-0 w-16 h-16 bg-gray-900 rounded-full"
                        style="right:-20px; bottom: -20px;">

                    </div>
                @endif

            </div>
            <div class="ml-12">
                <a href="{{ route('game.show', $game['slug']) }}"
                    class="block text-lg font-semi-bold leading-tight hover:text-gray-400 mt-4">{{ $game['name'] }}</a>
                <div class="text-gray-400 mt-1">{{ $game['platforms'] }}</div>

                <p class="text-gray-400 mt-6 hidden lg:block">{{ Str::limit($game['summary'], 170) }}</p>
            </div>

        </div>

    @empty
        @foreach (range(1, 3) as $game)
            <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
                <div class="relative flex-none">
                    <div class="bg-gray-700 w-32 lg:w-48 h-40 lg:h-56"></div>
                </div>
                <div class="ml-6 lg:ml-12">
                    <div class="inline-block text-lg font-semibold text-transparent bg-gray-700 rounded mt-4 leading-tight">
                        Title goes here</div>
                    <div class="space-y-4 mt-8 hidden lg:block">
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet
                            consectetur
                            terdffe</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet
                            consectetur
                            terdffe</span>
                        <span class="text-transparent bg-gray-700 rounded inline-block">Lorem ipsum dolor sit amet
                            consectetur
                            terdffe</span>
                    </div>
                </div>

            </div>
        @endforeach


    @endforelse



</div>

@push('scripts')
    @include('partials.rating', [
    'event' => 'recentlyGameWithRatingAdded',
    ])
@endpush
