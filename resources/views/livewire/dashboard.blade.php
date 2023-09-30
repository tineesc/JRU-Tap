<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="image dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div>
                <div class="max-w-6xl mx-auto mt-4">
                    <div class="py-2">
                        <form wire:submit.prevent="search" class="mb-4 sm:w-1/2 lg:w-1/3 z-10">
                            <div class="flex">
                                <div class="">
                                    <label for="location"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Location</label>
                                <select wire:model="locationFilter" id="location"
                                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">All Locations</option>
                                    @foreach ($locations as $loc)
                                        <option value="{{ $loc->location }}">{{ $loc->location }}</option>
                                    @endforeach
                                </select>
                                </div>

                                <div class="">
                                    <label for="destination"
                                    class="mt-4 mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Destination</label>
                                <select wire:model="destinationFilter" id="destination"
                                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">All Destinations</option>
                                    @foreach ($destinations as $dest)
                                        <option value="{{ $dest->destination }}">{{ $dest->destination }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <input wire:model="showAvailable" type="checkbox" id="showAvailable" class="mr-2">
                                <label for="showAvailable"
                                    class="text-sm font-medium text-gray-900 dark:text-white">Show Available
                                    Jeeps</label>
                            </div>

                            <button type="submit"
                                class="mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filter</button>

                            <button wire:click="reloadPage"
                                class="mt-4 ml-2 bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-white dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Reload
                                Page</button>

                        </form>

                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($items as $item)
                            <div class="py-2 text-center">
                                <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md">
                                    <p class="text-md font-semibold text-red-500">Date {{ $item->date }}</p>
                                    <p class="text-md font-semibold text-red-400">Time {{ $item->time }}</p>
                                    <h2 class="text-lg font-normal text-slate-500 mb-2 "> {{ $item->location }}</h2>
                                    <p class="grid justify-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </p>
                                    <h2 class="text-xl font-medium text-slate-700 mb-2"> {{ $item->destination }}</h2>
                                    <p class="text-md font-semibold text-slate-700">Plate Number {{ $item->jnumber }}
                                    </p>
                                    <p class="text-md font-semibold text-red-500">Price {{ $item->fare }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="py-2 z-10">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
