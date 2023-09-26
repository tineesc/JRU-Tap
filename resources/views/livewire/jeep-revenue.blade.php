<div>
    <form wire:submit.prevent="addRevenue">
        <div class="py-3 px-6">
            <x-label for="fare" value="{{ __('Fare') }}" />
            <x-input wire:model="fare" id="fare" class="block mt-1 w-full" type="number" name="fare" value="{{ $revenue }}" placeholder="Fare" 
            required autofocus autocomplete="fare" />
        </div>
        <div class="py-3 px-6">
            <x-label for="carid" value="{{ __('Card ID') }}" />
            <x-input  wire:model="cardid" id="cardid" class="block mt-1 w-full" type="number" name="cardid" :value="old('cardid')" placeholder="Scan ID"
                required autofocus autocomplete="cardid" />
        </div>
        
        <x-input wire:model="user" id="user" class="hidden mt-1 w-full" type="text" name="user" value="{{ Auth::user()->email }}" 
            required autofocus autocomplete="user" />
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
                                    <p class="text-md font-semibold text-slate-700">Driver {{ $item->email }}</p>
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