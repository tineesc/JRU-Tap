<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Credits Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="grid grid-cols rounded-lg shadow-md mb-3">
                    <div class="bg-sky-600 p-5">
                        <h2 class="font-semibol text-2xl">Virtual Card</h2>
                        <h2 class="font-semibol text-2xl font-semibold">Modern Jeepney (ACTONA)</h2>
                        <div class="pt-16 pb-10 flex justify-between">
                            <img src="/image/chip.png" alt="" class="max-w-full h-10" />
                            <h2 class="font-semibold text-2xl">{{ Auth::user()->name }}</h2>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-3xl pt-6 font-bold">{{ Auth::user()->card_id }}</p>
                            <p class="text-3xl pt-6">Logo</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-4 grid-flow-col gap-4 rounded shadow-md">
                    <div class="grid place-content-center row-span-4 col-span-4  bg-purple-50">
                        <form>
                            <h2 class="font-semibold text-3xl text-center text-slate-600 py-5">Top up Credits</h2>
                            <div class="mx-5 py-2">
                                <x-label for="email" value="{{ __('Credits') }}" />
                                <x-input id="credits" class="block mt-1 w-96" type="number" name="credits"
                                    :value="old('credits')" required autofocus autocomplete="credits" placeholder="amount"
                                    required />
                            </div>
                            <div class="mx-5 py-2">
                                <x-label for="cardID" value="{{ __('Card ID Number') }}" />
                                <x-input id="cardID" class="block mt-1 w-96" type="text" name="cardID"
                                    :value="old('cardID')" required autofocus autocomplete="cardID"
                                    placeholder="Card ID Number" required />
                            </div>
                            <div class="py-5 mx-5 text-center">
                                <x-button><a href="{{ route('pay') }}">Pay Card</a></x-button>
                                <x-button><a href="{{ route('linkPay') }}">Pay Link</a></x-button>
                            </div>
                        </form>
                    </div>
                    <div
                        class="grid place-content-center row-span-2 col-span-2 bg-purple-50 text-center rounded shadow-md">
                        <h2 class="font-semibold text-2xl  text-slate-600 py-2">Balance Credits</h2>
                        <p class="font-bold text-xl">{{ Auth::user()->card_amount }}</p>
                        <div class="py-5 mx-5 text-center">

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                wire:click="showModal">Register Card</button>
                        </div>
                    </div>
                    <div
                        class="grid place-content-center row-span-2 col-span-2 bg-purple-50 text-center rounded shadow-md">
                        <form action="">
                            <h2 class="font-semibold text-2xl  text-slate-600 py-2">Driver Wallet Balance</h2>
                            <p class="font-bold text-xl">{{ Auth::user()->wallet_amount }}</p>
                            <div class="py-5 mx-5 text-center">
                                <x-button>Send</x-button>
                                <x-button>Withdraw</x-button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Modal Start --}}
    <div class="max-w-6xl mx-auto">
        <x-dialog-modal wire:model="showingModal">

            <x-slot name="title">Link Card</x-slot>
            <x-slot name="content">
                <div class="text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Please Contact Administrator
                        to Link your Card!</h3>
                </div>
            </x-slot>
            <x-slot name="footer">
                {{-- <x-button 
                class="mx-2">Link</x-button> --}}
                <x-button wire:click="closeModal">Close</x-button>
            </x-slot>

        </x-dialog-modal>
    </div>
    {{-- Modal End  --}}

</div>
