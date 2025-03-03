<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eco Map') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold">{{ $employee->name }}</h2>
                    
                    <!-- Imagen más grande -->
                    <img src="{{ asset('storage/' . $employee->foto) }}" alt="{{ $employee->name }}" class="w-128 h-128 rounded-full mt-4 mx-auto">

                    <!-- Botón para regresar al dashboard -->
                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="w-full bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800 text-center">
                            Regresar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
