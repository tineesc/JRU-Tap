<div class="py-4">
    <div class="mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
        <div class="image dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-5 mx-auto mt-4">

                <form wire:submit.prevent="search" class="mb-4 sm:w-1/2 lg:w-1/3 z-10">
                    <div class="flex py-2">

                        {{-- Location Button --}}
                        <label for="location"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Location</label>
                        <select wire:model="locationFilter" id="location"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Locations</option>
                            @foreach ($locations as $loc)
                                <option value="{{ $loc->location }}">{{ $loc->location }}</option>
                            @endforeach
                        </select>

                        {{-- Destination Button --}}
                        <label for="destination"
                            class="mt-4 mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Destination</label>
                        <select wire:model="destinationFilter" id="destination"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>All Destinations</option>
                            @foreach ($destinations as $dest)
                                <option value="{{ $dest->destination }}">{{ $dest->destination }}</option>
                            @endforeach
                        </select>


                        {{-- Filter Search Button --}}
                        <button type="submit"
                            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                            <span class="sr-only">Search</span>
                        </button>

                        {{-- Reload Page Button  --}}
                        <button wire:click="reloadPage"
                            class="p-2.5 ml-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>


                
                     {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">   
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
                </div> --}}




                {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Destination
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Plate Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fare
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th class="px-6 py-4">
                                    {{ $item->date }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->time }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->location }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->destination }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->jnumber }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->fare }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-2 z-10">
                    {{ $items->links() }}
                </div> --}}


                <div class="hidden sm:max-w:block md:hidden lg:block xl:block">
                    <!-- Content for Laptop and Desktop View -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Location
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Destination
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Plate Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fare
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th class="px-6 py-4">
                                            {{ $item->date }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $item->time }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->location }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->destination }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->jnumber }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->fare }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="block sm:max-w:hidden md:block lg:hidden xl:hidden">
                    <!-- Content for Mobile and Tablet View -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($items as $item)
                        <div class="py-2 text-center">
                            <div class="py-2 text-center">
                                <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md">
                                    <p class="text-md font-semibold text-red-500">Date {{ $item->date }}</p>
                                    <p class="text-md font-semibold text-red-400">Time {{ $item->time }}</p>
                                    <h2 class="text-lg font-normal text-slate-500 mb-2 "> {{ $item->location }}</h2>
                                    <p class="grid justify-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-6 h-6">
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
                        </div>
                    @endforeach
                    </div>
                </div>
                
                <div class="py-2 z-10">
                    {{ $items->links() }}
                </div> 

            </div>
        </div>
    </div>
</div>
