<div>
    <div>

        {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Driver
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jeep
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Arrival
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
                @forelse ($items as $item)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                       
                        <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $item->driver }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $item->jnumber }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->begin }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="#"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $item->status }}</a>
                    </td>
                        @empty
                            <p class="text-center text-lg p-5">No Jeep in Queue</p>
                        @endforelse
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            {{ $items->links() }}
        </div> --}}

        <div class="hidden sm:max-w:block md:hidden lg:block xl:block">
            <!-- Content for Laptop and Desktop View -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Driver
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Jeep
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DateTime
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th class="px-6 py-4">
                                    {{ $item->driver }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->jnumber }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->status }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->updated_at }}
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
                            <p class="text-md font-semibold text-red-500">Date {{ $item->driver }}</p>
                            <p class="text-md font-semibold text-red-400">Time {{ $item->jnumber }}</p>
                            <p class="text-md font-semibold text-red-500">Price {{ $item->status }}</p>
                            <p class="text-md font-semibold text-red-500">DateTime {{ $item->updated_at }}</p>
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
