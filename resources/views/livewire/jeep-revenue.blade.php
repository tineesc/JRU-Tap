<div>
    <form wire:submit.prevent="addRevenue">
        <div class="p-6">
            <x-label for="carid" value="{{ __('Card ID') }}" />
            <x-input  wire:model="cardid" id="cardid" class="block mt-1 w-full" type="number" name="cardid" :value="old('cardid')" placeholder="Scan ID"
                required autofocus autocomplete="cardid" />
        </div>
        <x-button class="hidden">{{ __('Scan') }}</x-button>
    </form>


<div>
                    <div class="max-w-6xl mx-auto mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($items as $item)
                            <div class="py-2 text-center">
                                <div class="p-4 bg-slate-50 bg-opacity-75 shadow-lg rounded-md">
                                    <p class="text-md font-semibold text-red-500">ID {{ $item->card_id }}</p>
                                    <p class="text-md font-semibold text-red-400">Balance {{ $item->card_amount }}</p>
                                    <p class="text-md font-semibold text-slate-700">Fare {{ $item->fare }}</p>
                                    <p class="text-md font-semibold text-slate-700">Jeep {{ $item->jnumber }}</p>
                                    <p class="text-md font-semibold text-slate-700">Payment {{ $item->payment_method }}</p>
                                    <p class="text-md font-semibold text-slate-700">Status {{ $item->status }}</p>
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