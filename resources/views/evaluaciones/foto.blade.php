<x-app-layout>
    <x-slot name="header">
        <h2 class="bg-white dark:bg-gray-800 leading-tight">Foto de Evaluación</h2>
    </x-slot>

    <div class="py-12 flex flex-col items-center">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center w-full">
                <h3 class="text-lg font-bold mb-4">{{ $evaluation->employee->name }} - {{ \Carbon\Carbon::parse($evaluation->evaluation_date)->format('d/m/Y') }}</h3>
                @if ($evaluation->photo_path)
                    <img src="{{ asset('storage/' . $evaluation->photo_path) }}" class="rounded-lg shadow-lg max-w-full">
                @else
                    <p class="text-gray-500">No hay foto disponible.</p>
                @endif
                <a href="{{ route('employees.chart') }}" class="mt-4 bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                    ← Regresar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
