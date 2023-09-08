<div>
    <div class="max-w-6xl mx-auto mt-4">
        <table class="min-w-full border-collapse border border-gray-300">

            <div class="py-2">
                <form wire:submit="search" >
                    <label for="default-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input wire:model.live="query" type="text" id="default-search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Location">
                        {{-- <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button> --}}
                    </div>
                </form>
            </div>

            <tbody>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($items as $item)
                        <div class="py-2 text-center">
                            <div class="p-4 bg-white shadow-lg rounded-md">
                                <p class="text-md font-semibold text-red-500">ID {{ $item->id }}</p>
                                <h2 class="text-lg font-normal text-slate-500 mb-2 "> {{ $item->location }}</h2>
                                <p class="grid justify-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </p>
                                <h2 class="text-xl font-medium text-slate-700 mb-2"> {{ $item->destination }}</h2>
                                <p class="text-md font-semibold text-red-500">Plate Number {{ $item->jnumber }}</p>
                                <p class="text-md font-semibold text-red-500">Price {{ $item->fare }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </tbody>
            <div class="py-2">
                {{ $items->links() }}
            </div>
        </table>
    </div>
</div>
