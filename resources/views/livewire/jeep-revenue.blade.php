<div>
    <div class="relative p-3 m-5">
        <button type="button" wire:click="driving"
            class="relative px-5 mr-5 inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Driving
        </button>
        <button type="button" wire:click="departure"
            class="relative px-5 inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Departure
        </button>
        <button type="button" wire:click="updateQueue"
            class="absolute top-0 right-0  inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
            </svg>

            <span class="sr-only">Notifications</span>
            <div
                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
            </div>
        </button>
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




    <form wire:submit.prevent="addRevenue">
        <div class="py-3 px-6 w-full">
            @forelse($trips as $trip)
                <x-label for="Location" value="{{ __('Location') }}" />
                <input type="text"
                    class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    value="{{ $trip->location }}" readonly>

                <td>
                    <input type="text"
                        class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        value="{{ $trip->destination }}" readonly>
                </td>
                <td>
                    <input wire:model="fare" type="text"
                        class="form-control border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        :value="{{ $trip->fare }}" readonly>
                </td>

            @empty
                <tr>
                    <td colspan="3">No trips found for you.</td>
                </tr>
            @endforelse
        </div>
        <div class="py-3 px-6">
            <x-label for="carid" value="{{ __('Card ID') }}" />
            <x-input wire:model="cardid" id="cardid" class="block mt-1 w-full" type="number" name="cardid"
                :value="old('cardid')" placeholder="Scan ID" required autofocus autocomplete="cardid" />
        </div>

        <x-input wire:model="user" id="user" class="hidden mt-1 w-full" type="text" name="user"
            value="{{ Auth::user()->name }}" required autofocus autocomplete="user" />
        <x-button class="hidden">{{ __('Scan') }}</x-button>
    </form>


    <div>
        <div class="max-w-6xl mx-auto mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($items as $item)
                    <div class="py-2 text-center">
                        <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md uppercase">
                            <p class="text-md font-semibold text-red-500">ID {{ $item->card_id }}</p>
                            <p class="text-md font-semibold text-slate-700">Fare {{ $item->fare }}</p>
                            <p class="text-md font-semibold text-slate-700">Payment {{ $item->payment_method }}</p>
                            <p class="text-md font-semibold text-slate-700">Status {{ $item->status }}</p>
                            <p class="text-md font-semibold text-slate-700">Driver {{ $item->name }}</p>
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
