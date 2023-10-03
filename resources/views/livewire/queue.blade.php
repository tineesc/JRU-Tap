<div>
    <div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                @forelse ($items as $item)
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
                            Action
                        </th>
                    </tr>
                </thead>
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
        </div>
    </div>
</div>
