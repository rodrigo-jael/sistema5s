<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 dark:text-blue-400 leading-tight text-center">
            {{ __('Listado de consumo ') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Detalle del Consumo</h1>

        <!-- Mostrar los datos del último consumo -->
        @if ($consumo)
            <p><strong>Fecha:</strong> {{ $consumo->fecha }}</p>
            <p><strong>Semana:</strong> {{ $consumo->semana }}</p>
            <p><strong>Litros Consumidos:</strong> {{ $consumo->litros_consumidos }}</p>
            <p><strong>Litros Ahorrados:</strong> {{ 450 - $consumo->litros_consumidos }}</p>
        @else
            <p>No hay registros de consumo.</p>
        @endif

        <a href="{{ route('consumo_agua.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Volver</a>
    </div>
    
</x-app-layout>
