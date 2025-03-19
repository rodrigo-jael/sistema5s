<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 dark:text-blue-400 leading-tight text-center">
            {{ __('Registrar Consumo de Agua') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('error') || session('success'))
                        <div class="p-4 rounded-md mb-4 {{ session('error') ? 'bg-red-500' : 'bg-green-500' }} text-white">
                            {{ session('error') ?? session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('consumo_agua.store') }}">
                        @csrf
                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Registrar Consumo de Agua</h3>
                            <div>
                                <a href="{{ route('consumo_agua.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                    Regresar
                                </a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="mb-4">
                                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('fecha')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="litros_consumidos" class="block text-sm font-medium text-gray-700">Litros Consumidos</label>
                                <input type="number" name="litros_consumidos" id="litros_consumidos" value="{{ old('litros_consumidos') }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" max="450">
                                @error('litros_consumidos')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Guardar Registro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
