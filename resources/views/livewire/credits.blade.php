<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 rounded shadow-md mb-3">
                <!-- Top-Up Credits Form -->
                <div class="bg-sky-500 rounded-lg">
                    <!-- Content -->
                    <form action="{{ route('pay') }}">
                        @csrf
                        <h2 class="font-semibold text-3xl text-center text-slate-950 py-5 mx-auto">Top up Credits</h2>
                        <div class="mx-6 py-2">
                            <x-label for="credits" value="{{ __('Credits') }}" />
                            <x-input wire:model="credits" id="credits" class="block mt-1 w-full md:w-92 mx-auto"
                                type="text" name="credits" required autofocus autocomplete="credits"
                                placeholder="amount" required {{-- Numbers only Validation --}}
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />

                        </div>
                        <div class="mx-6 py-2">
                            <x-label for="cardid" value="{{ __('Card ID Number') }}" />
                            <x-input wire:model="cardid" id="cardid" class="block mt-1 w-full md:w-92 mx-auto"
                                type="text" name="cardid" required autofocus autocomplete="cardid"
                                placeholder="Card ID Number" required {{-- Numbers only Validation --}}
                                oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" />
                        </div>

                        <div class="py-5 mx-5 pl-2">
                            <x-button class="uppercase">add credits</x-button>
                        </div>
                    </form>
                </div>

                <!-- Balance Credits -->
                {{-- <div class="grid place-content-center bg-purple-50 text-center">
                    <form action="">
                        <!-- Content -->
                        <h2 class="font-semibold text-2xl  text-slate-600 py-2">Card Balance Credits</h2>
                        <p class="font-bold text-xl">
                            @if ($cardBalance !== null)
                                <p class="semi-bold">{{ $cardBalance }}</p>
                            @else
                                <p>No Balance to show</p>
                            @endif
                        </p>

                        <div class="py-5 mx-5 text-center">
                            <x-button>Register Card</x-button>
                        </div>
                    </form>
                </div> --}}

                <!-- Driver Wallet Balance (Only for Role 4) -->
                {{-- @role(4)
                    <div class="grid place-content-center bg-purple-50 text-center">
                        <form>
                            <!-- Content -->
                            <h2 class="font-semibold text-2xl  text-slate-600 py-2">Driver Wallet Balance</h2>
                            <p class="font-bold text-xl">
                                @if (Auth::user()->wallet_balance)
                                    {{ Auth::user()->wallet_balance }}
                                @else
                                    No Balance to show
                                @endif
                            </p>
                            <div class="py-5 mx-5 text-center">
                                <x-button>Send</x-button>
                                <x-button>Withdraw</x-button>
                            </div>
                        </form>
                    </div>
                @endrole --}}

                 <!-- Virtual Card Section -->
            <div class="flex justify-center">
                <div class="block w-full rounded-lg bg-sky-500 p-5">
                    <!-- Content -->
                    <h2 class="font-semibold text-2xl">Virtual Card</h2>
                    <h2 class="font-semibold text-2xl">(ACTONA)</h2>
                    <div class="pt-16 pb-10 flex flex-col md:flex-row justify-between items-center">
                        <img src="/image/chip.png" alt="" class="max-w-full h-10 md:w-20 md:h-12  mb-4 md:mb-0" />
                        <h2 class="font-semibold text-2xl">{{ Auth::user()->name }}</h2>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-3xl pt-6 font-bold" id="myText">
                            @if (Auth::user()->card_id)
                                {{ Auth::user()->card_id }}
                            @else
                                No Register Card ID
                            @endif
                        </p>
                        <button id="copy-button" class="onclick:text-red-200 rounded-md text-white p-2 mt-2 z-10"
                            onclick="copyContent()">Copy to Clipboard
                        </button>
                    </div>
                </div>
            </div>
            </div>

           


            <div class="hidden sm:max-w:hidden md:block lg:block xl:block">
                <!-- Content for Laptop and Desktop View -->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Card ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cards as $card)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $card->card_id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $card->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $card->status }}
                                    </td>
                                </tr>
                            @empty
                                <th class="uppercase text-lg font-semibold">No Data Found</th>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="block sm:max-w:hidden md:block lg:hidden xl:hidden">
                <!-- Content for Mobile and Tablet View -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <!-- Your mobile and tablet content here -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        @foreach ($cards as $card)
                            <div class="py-2 text-center">
                                <div class="py-2 text-center">
                                    <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md">
                                        <p class="text-md font-semibold text-red-500">Date {{ $card->card_id }}</p>
                                        <p class="text-md font-semibold text-red-400">Time {{ $card->amount }}</p>
                                        <p class="text-md font-semibold text-red-500">Price {{ $card->status }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="py-2 px-3">
                    {{ $cards->links() }}
                </div>
            </div>


        </div>
    </div>





    <script>
        let text = document.getElementById('myText').innerHTML;
        const copyContent = async () => {
            try {
                await navigator.clipboard.writeText(text);
                console.log('Content copied to clipboard');

                // Change the button text to indicate success
                document.getElementById('copy-button').textContent = 'Copied!';

                // Revert the button text to its original state after 3 seconds
                setTimeout(() => {
                    document.getElementById('copy-button').textContent = 'Copy to Clipboard';
                }, 3000); // 3000 milliseconds = 3 seconds
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }
    </script>
