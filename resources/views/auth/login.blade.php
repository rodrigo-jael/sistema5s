<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 border-t-4 border-yellow-500">
            
            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('storage/images/logojorial.png') }}" alt="QMS Logo" class="w-24 h-auto">
            </div>

            <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-gray-200">INICIAR SESIÓN</h2>
            <p class="text-center text-sm text-yellow-600 font-semibold mb-4">BIENVENIDO, INTRODUCE TUS CREDENCIALES</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 dark:text-gray-300" />
                    <input id="email" class="block w-full py-2 border-b-2 border-gray-400     focus:outline-none focus:border-yellow-500 bg-transparent text-gray-800 dark:text-gray-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-300" />
                    <input id="password" class="block w-full py-2 border-b-2 border-gray-400 focus:outline-none focus:border-yellow-500 bg-transparent text-gray-800 dark:text-gray-200" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-md shadow-md">Ingresar</button>
                </div>
            </form>

            <p class="text-center text-xs text-gray-600 dark:text-gray-400 mt-4">Si tienes problemas contacta al área de sistemas: <a href="mailto:soporte@qms.com.mx" class="text-yellow-700 underline">soporte@qms.com.mx</a></p>
        </div>
    </div>
</x-guest-layout>
