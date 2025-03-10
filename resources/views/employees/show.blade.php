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
                    <!-- Botón para regresar al dashboard a la derecha -->
                    <div class="mb-6 text-right">
                        <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">
                            Regresar
                        </a>
                    </div>

                    <h2 class="text-2xl font-bold">{{ $employee->name }}</h2>

                    <!-- Imagen más grande -->
                    <img src="{{ asset('storage/' . $employee->foto) }}" alt="{{ $employee->name }}" class="w-100 h-100 rounded-full mt-4 mx-auto">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
