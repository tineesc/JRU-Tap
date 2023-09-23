<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> <!-- Added responsive padding -->
            <div class="image dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <div class="max-w-6xl mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            {{-- @foreach ($items as $item)
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
                                    <p class="text-md font-semibold text-slate-700">Plate Number {{ $item->jnumber }}</p>
                                    <p class="text-md font-semibold text-red-500">Price {{ $item->fare }}</p>
                                </div>
                            </div>
                        @endforeach --}}
                        </div>
                        <div class="py-2 z-10">
                            {{-- {{ $items->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
