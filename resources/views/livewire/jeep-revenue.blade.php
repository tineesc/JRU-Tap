<div>
    <form action="">
        <div class="p-12">
            <x-label for="carid" value="{{ __('Scan') }}" />
            <x-input id="cardid" class="block mt-1 w-full" type="number" name="cardid" :value="old('cardid')"
                required autofocus autocomplete="cardid" />
        </div>
        <x-button class="hidden">{{ __('Scan') }}</x-button>
    </form>
</div>
