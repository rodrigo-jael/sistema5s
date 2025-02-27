<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registros de Evaluación 5S') }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col items-center">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center">
                
                <!-- Mostrar el mensaje de error si existe -->
                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Formulario para seleccionar la fecha -->
                <form method="POST" action="{{ route('evaluations.store') }}" class="mb-4">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <select name="date" id="dateField" class="p-2 border rounded-md">
                            <option value="">Seleccione una fecha</option>
                            @foreach ($dates as $date)
                                <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filtrar por fecha
                        </button>
                        <a href="{{ route('welcome') }}" class="bg-green-500 text-black px-6 py-2 rounded-md text-lg hover:bg-blue-600 transition">
                            Regresar
                        </a>
                    </div>
                </form>

                <!-- Mostrar los registros en una tabla -->
                <div class="overflow-x-auto w-full mt-6">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left">Empleado</th>
                                <th class="px-4 py-2 text-left">Fecha</th>
                                <th class="px-4 py-2 text-left">Cumplimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaluations as $evaluation)
                                <tr class="bg-white dark:bg-gray-800 border-b">
                                    <td class="px-4 py-2">{{ $evaluation->employee->name }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($evaluation->evaluation_date)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">
                                        <span class="{{ $evaluation->evaluation_5s == 'cumplio' ? 'text-green-500' : 'text-red-500' }}">
                                            {{ ucfirst($evaluation->evaluation_5s) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
