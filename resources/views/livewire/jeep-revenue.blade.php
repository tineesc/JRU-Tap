<div>
    <div class="relative p-3 m-5">
        <div class="flex flex-col md:flex-row justify-between items-center">
            
            
            <div>
                <div id="toast-simple"
                    class="flex items-center w-full max-w-xs p-2 md:p-4 space-x-2 md:space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800"
                    role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    <div class="pl-2 md:pl-4 text-sm font-normal">
                        @forelse ($jnumber as $jeep)
                            <p>Plate Number: {{ $jeep->jnumber }}</p>
                        @empty
                            <p>Plate Number: No Assign Jeep</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button type="button" @click="open = !open"
                    class="relative px-4 md:px-5 inline-flex items-center p-2 md:p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ $selectedOption ?? 'Select Action' }}
                    <span class="ml-2">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" class="w-4 h-4">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </span>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <a wire:click="driving" type="button"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            role="menuitem">Driving</a>
                        <a wire:click="departure" type="button"
                            onclick="return confirm('Are you sure you want to perform this action?');"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            role="menuitem">Departure</a>
                        <a wire:click="failed" type="button"
                            onclick="return confirm('Are you sure you want to perform this action?');"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            role="menuitem">Failed</a>
                        <a wire:click="break" type="button" onclick="return confirm('Confirm your Request for Break?');"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            role="menuitem">Break</a>
                        <a wire:click="lunch" type="button" onclick="return confirm('Confirm your Request for Lunch?');"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                            role="menuitem">Lunch</a>
                    </div>
                </div>
            </div>
            <div class="order-last mt-3 md:mt-0"> <!-- Add margin top on mobile screens -->
                <button type="button" wire:click="updateQueue"
                    class=" inline-flex items-center p-2 md:p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                    </svg>
                    <span class="sr-only">Notifications</span>
                </button>
            </div>
        </div>
    </div>

    <div x-data="{ showNotification: false, message: '', error: '' }" x-init="() => {
        showNotification = {{ session('message') || session('error') ? 'true' : 'false' }};
        message = showNotification && '{{ session('message') }}';
        error = showNotification && '{{ session('error') }}';
        if (showNotification) {
            setTimeout(() => {
                showNotification = false;
            }, 2000);
        }
    }" x-show="showNotification"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-0 right-0 p-4 z-50">

        @if (session('message'))
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md text-lg">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-md text-lg">
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <form wire:submit.prevent="addRevenue">
            <div class="py-3 px-6">
                @forelse($trips as $trip)
                    <div class="my-3">
                        <x-label for="Location" value="{{ __('Location') }}" />
                        <input type="text"
                            class="block w-full p-2 sm:p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $trip->location }}" readonly>
                        <x-label for="destination" value="{{ __('Destination') }}" />
                        <input type="text"
                            class="block w-full p-2 sm:p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $trip->destination }}" readonly>
                        <div>
                            <x-label for="fare" value="{{ __('Fare') }}" />
                            <input wire:model="fare" type="text" name="fare" id="fare"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                readonly>
                        </div>
                        <div>
                            <x-label for="trips" value="{{ __('Trips') }}" />
                            <input type="text" name="trips" id="trips"
                                class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $trip->trips }}" readonly>
                        </div>
                    </div>
                @empty
                    <div>
                        <td colspan="3">No trips found for you.</td>
                    </div>
                @endforelse
            </div>
            <div class="py-3 px-6">
                <x-label for="cardid" value="{{ __('Card ID') }}" />
                <x-input wire:model="cardid" id="cardid" class="block mt-1 w-full sm:w-48 md:w-64" type="number"
                    name="cardid" placeholder="Scan ID" required autofocus autocomplete="cardid" />
            </div>

            <x-input wire:model="user" id="user" class="hidden mt-1 w-full" type="text" name="user"
                value="{{ Auth::user()->name }}" required autofocus autocomplete="user" />
            <div class="py-3 px-6">
                <x-button class="hidden w-full sm:w-48 md:w-64" type="submit">{{ __('Scan') }}</x-button>
            </div>

        </form>
    </div>




    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($items as $item)
            <div class="py-2 text-center">
                <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md uppercase">
                    <p class="text-md font-semibold text-red-500">ID {{ $item->card_id }}</p>
                    <p class="text-md font-semibold text-slate-700">Fare {{ $item->fare }}</p>
                    <p class="text-md font-semibold text-slate-700">Payment {{ $item->payment_method }}</p>
                    <p class="text-md font-semibold text-slate-700">Status {{ $item->status }}</p>
                    <p class="text-md font-semibold text-slate-700">Balance
                        @foreach ($cardData as $data)
                            @if ($data->card_id === $item->card_id)
                                {{ $data->card_balance }}
                            @endif
                        @endforeach
                    </p>
                    <p class="text-md font-semibold text-slate-700">Driver {{ $item->name }}</p>
                </div>
            </div>
        @endforeach
    </div>



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="p-5 uppercase text-lg font-semibold">Trip logs</div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                <th scope="col" class="px-6 py-3">
                    Destination
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Jeep
                </th>
                <th scope="col" class="px-6 py-3">
                    Trip
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($triplogs as $triplog)
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{ $triplog->location }}
                </th>
                <td class="px-6 py-4">
                    {{ $triplog->destination }}
                </td>
                <td class="px-6 py-4">
                    {{ $triplog->date }}
                </td>
                <td class="px-6 py-4">
                    {{ $triplog->jnumber }}
                </td>
                <td class="px-6 py-4">
                    {{ $triplog->trips }}
                </td>
                <td class="px-6 py-4">
                    {{ $triplog->status }}
                </td>
            </tr>
            @empty
            <div>
                <td colspan="3">No trips found for you.</td>
            </div>
        @endforelse
        </tbody>
    </table>
</div>

    


</div>
