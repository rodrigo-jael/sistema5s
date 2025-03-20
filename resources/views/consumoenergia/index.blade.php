<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 dark:text-blue-400 leading-tight text-center">
            {{ __('Historial de Consumo de Energía') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Consumo de Energía</h1>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('luz.index') }}" class="px-6 py-3 bg-gray-600 text-white rounded-md shadow-md hover:bg-gray-700 transition duration-300">
                Regresar
            </a>
        </div>
         



        <!-- Formulario para agregar un nuevo registro -->
        <form action="{{ route('consumoenergia.store') }}" method="POST" class="mb-4 p-4 bg-gray-100 rounded">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="fecha" class="block">Fecha:</label>
                    <input type="date" name="fecha" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="mes" class="block">Mes:</label>
                    <input type="text" name="mes" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="kwh_consumidos" class="block">kWh Consumidos:</label>
                    <input type="number" step="0.01" name="kwh_consumidos" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label for="kwh_presupuestado" class="block">kWh Presupuestado:</label>
                    <input type="number" step="0.01" name="kwh_presupuestado" class="w-full p-2 border rounded">
                </div>
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Guardar</button>
        </form>

       
    </div>
</x-app-layout>

