<x-guest-layout>
    <div class="w-full max-w-md bg-white dark:bg-gray-800  shadow-lg rounded-lg p-8">
        <!-- Logo de Jorial -->
        <div class="flex justify-center mb-6">
            <img src="{{ ('storage/images/logojorial.png') }}" alt="" class="w-32 h-auto">
        </div>

        <h2 class="text-3xl font-bold text-black-700 text-center">Iniciar Sesión</h2>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correo')" class="text-black-700" />
                <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" class="text-black-700" />
                <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black-600 shadow-sm focus:ring-black-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center mt-6 space-y-4">
                <x-primary-button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow-md w-full">
                    {{ __('Log in') }}
                </x-primary-button>

                <div class="flex justify-between w-full text-sm text-gray-600">
                    @if (Route::has('password.request'))
                        <a class="underline hover:text-purple-700" href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña?') }}
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a class="underline hover:text-purple-700" href="{{ route('register') }}">
                            {{ __('Registro') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
