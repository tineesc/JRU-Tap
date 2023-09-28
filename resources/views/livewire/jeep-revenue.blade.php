<div>
    <div x-data="{ showNotification: false, message: '', error: '' }"
    x-init="() => {
       showNotification = {{ session('message') || session('error') ? 'true' : 'false' }};
       message = showNotification && '{{ session('message') }}';
       error = showNotification && '{{ session('error') }}';
       if (showNotification) {
           setTimeout(() => {
               showNotification = false;
           }, 2000);
       }
    }"
    x-show="showNotification"
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-2"
    class="fixed bottom-0 right-0 p-4 z-50">

   @if(session('message'))
   <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md text-lg">
       <p>{{ session('message') }}</p>
   </div>
   @endif

   @if(session('error'))
   <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-md text-lg">
       <p>{{ session('error') }}</p>
   </div>
   @endif
</div>




    

    <form wire:submit.prevent="addRevenue">
        <div class="py-3 px-6">
            <x-label for="fare" value="{{ __('Fare') }}" />
            <x-input wire:model="fare" id="fare" class="block mt-1 w-full" type="number" name="fare"
                value="{{ $revenue }}" placeholder="Fare" required autofocus autocomplete="fare" />
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
