<x-guest-layout>

    <x-authentication-card>

        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex flex-col-reverse md:flex-row">

            <form class="w-full self-center" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-label for="email" value="{{ __('Email') }}" class="block text-center md:text-left" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mb-4">
                    <x-label for="password" value="{{ __('Password') }}"  class="block text-center md:text-left"/>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mb-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center md:flex-row md:items-center justify-between mt-4">
                    <div>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                  <div class="flex flex-col items-center md:flex-row md:items-center justify-center md:justify-between mt-4">
                    <x-button >
                        {{ __('Log in') }}
                    </x-button>
                  </div>
                </div>
            </form>

            <div class="w-full md:w-1/2 mb-8 block place-content-center px-5 py-5">
                <img class="image w-full" src="{{ url('https://i.pinimg.com/736x/f1/17/e8/f117e815732266479c1ed21534d4ec26.jpg') }}" alt="Image" />
            </div>

        </div>

    </x-authentication-card>
</x-guest-layout>
