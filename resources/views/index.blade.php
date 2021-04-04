@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Popular Games</h2>
        <livewire:popular-games /> <!-- end of popular game -->

        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-reviewed w-full lg:w-3/4 mr-0 lg:mr-32">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Recently Reviewed</h2>
                <div class="recently-reviewed-container space-y-12 mt-8">
                    @foreach ($recentlyReviewed as $game)


                        <div class="game bg-gray-800 rounded-lg shadow-md flex p-6">
                            <div class="relative flex-none">
                                <a href="#"><img
                                        src="{{ Str::replaceFirst('thumb', 'cover_big', $game['cover']['url']) }}"
                                        alt="image" class="w-48 hover:opacity-75 transition ease-in-out duration-200"></a>

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

                    @endforeach



                </div>

            </div>
            <div class="most-anticipated lg:w-1/4 mt-12 lg:mt-0">
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Most Anticipated</h2>
                <div class="most-anticipated-container space-y-10 mt-8">
                    @foreach ($mostAnticipated as $game)
                        <div class="game flex">
                            <a href="#"><img src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}"
                                    alt="image" class="w-16 hover:opacity-75 transition ease-in-out duration-200"></a>

                            <div class="ml-4">
                                <a href="#" class="hover:text-gray-300">{{ $game['name'] }}</a>
                                <div class="text-gray-400 text-sm mt-1">
                                    {{ Carbon\Carbon::parse($game['first_release_date'])->format('M d, Y') }}</div>
                            </div>
                        </div>

                    @endforeach


                    <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Coming soon</h2>
                    <div class="most-anticipated-container space-y-10 mt-8">
                        @foreach ($comingSoon as $game)
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

                        @endforeach


                    </div>
                </div>
            </div>

        </div> <!-- end of container -->
    @endsection
