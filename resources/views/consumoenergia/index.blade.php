<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 dark:text-blue-400 leading-tight text-center">
            {{ __('Registrar Consumo de Energía') }}
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

                    <form method="POST" action="{{ route('consumoenergia.store') }}">
                        @csrf
                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Registrar Consumo de Energía</h3>
                            <div>
                                <a href="{{ route('luz.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
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
                                <label for="mes" class="block text-sm font-medium text-gray-700">Mes</label>
                                <input type="text" name="mes" id="mes" value="{{ old('mes') }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('mes')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kwh_consumidos" class="block text-sm font-medium text-gray-700">kWh Consumidos</label>
                                <input type="number" step="0.01" name="kwh_consumidos" id="kwh_consumidos" value="{{ old('kwh_consumidos') }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('kwh_consumidos')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="kwh_presupuestado" class="block text-sm font-medium text-gray-700">kWh Presupuestado</label>
                                <input type="number" step="0.01" name="kwh_presupuestado" id="kwh_presupuestado" value="{{ old('kwh_presupuestado') }}" class="mt-1 block w-full px-4 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('kwh_presupuestado')
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
