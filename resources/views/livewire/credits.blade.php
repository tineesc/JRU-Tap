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
                            <p class="text-3xl pt-6 font-bold">
                                @if (Auth::user()->card_id)
                                    {{ Auth::user()->card_id }}
                                @else
                                    No Register Card ID
                                @endif
                            </p>
                            <p class="text-3xl pt-6">Logo</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-rows-4 grid-flow-col gap-4 rounded shadow-md">
                    <div class="grid place-content-center row-span-4 col-span-4  bg-purple-50">
                        <form action="{{ route('process') }}">
                            <h2 class="font-semibold text-3xl text-center text-slate-600 py-5">Top up Credits</h2>
                            <div class="mx-5 py-2">
                                <x-label for="credits" value="{{ __('Credits') }}" />
                                <x-input id="credits" class="block mt-1 w-96" type="text" name="credits"
                                    :value="old('credits')" required autofocus autocomplete="credits" placeholder="amount"
                                    required />
                            </div>
                            <div class="mx-5 py-2">
                                <x-label for="cardID" value="{{ __('Card ID Number') }}" />
                                <x-input id="cardID" class="block mt-1 w-96" type="text" name="cardID"
                                    :value="old('cardID')" required autofocus autocomplete="cardID"
                                    placeholder="Card ID Number" required />
                            </div>

                            <div class="mx-5 py-2">

                                <label for="payment"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                                    option</label>
                                <select id="payment" name="payment"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a country</option>
                                    <option value="pay">Card</option>
                                    <option value="link">Link</option>
                                </select>

                            </div>

                            <div class="py-5 mx-5 text-center">
                                <x-button>Pay Card</x-button>
                              
                            </div>
                        </form>
                    </div>
                    <div
                        class="grid place-content-center row-span-2 col-span-2 bg-purple-50 text-center rounded shadow-md">
                        <form action="">
                            <h2 class="font-semibold text-2xl  text-slate-600 py-2">Balance Credits</h2>
                            <p class="font-bold text-xl">
                                @if (Auth::user()->card_amount)
                                    {{ Auth::user()->card_amount }}
                                @else
                                    No Balance to show
                                @endif
                            </p>
                            <div class="py-5 mx-5 text-center">
                                <x-button>Register Card</x-button>
                            </div>
                        </form>
                    </div>
                    <div
                        class="grid place-content-center row-span-2 col-span-2 bg-purple-50 text-center rounded shadow-md">
                        <form action="">
                            <h2 class="font-semibold text-2xl  text-slate-600 py-2">Driver Wallet Balance</h2>
                            <p class="font-bold text-xl">
                                @if (Auth::user()->wallet_amount)
                                    {{ Auth::user()->wallet_amount }}
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
                </div>

            </div>
        </div>
    </div>

</div>
