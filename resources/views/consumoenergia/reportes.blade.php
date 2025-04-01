<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-600 dark:text-blue-400 leading-tight text-center" style="color: #D5AC5B;">
            {{ __('Historial de Consumo de Energía') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4" style="color: #D5AC5B;">Reportes de Consumo de Energía</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('luz.index') }}" class="bg-red-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 transition duration-300"  style="background-color: #D5AC5B;">
                Regresar
            </a>
        </div>

        <!-- Tabla de registros -->
        <table class="w-full bg-white shadow-md rounded">
            <thead style="background-color: #D5AC5B; color: white;">
                <tr>
                    <th class="p-2">Fecha</th>
                    <th class="p-2">Mes</th>
                    <th class="p-2">kWh Consumidos</th>
                    <th class="p-2">Consumo Ahorrado</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumos as $consumo)
                <tr class="border-b">
                    <td class="p-2">{{ $consumo->fecha }}</td>
                    <td class="p-2">{{ $consumo->mes }}</td>
                    <td class="p-2">{{ $consumo->kwh_consumidos }}</td>
                    <td class="p-2">{{ $consumo->kwh_presupuestado - $consumo->kwh_consumidos }}</td>
                    <td class="p-2 flex justify-center">
                        @if($consumo->pdf_recibo)
                            <a href="{{ route('consumoenergia.descargarRecibo', $consumo->id) }}" 
                               class=" text-white px-3 py-1 rounded-md hover:bg-blue-600" style="background-color: #D5AC5B;">
                                Descargar PDF
                            </a>
                        @else
                            <form action="{{ route('consumoenergia.subirRecibo', $consumo->id) }}" method="POST" enctype="multipart/form-data" class="flex">
                                @csrf
                                <input type="file" name="pdf_recibo" accept="application/pdf" required class="mr-2">
                                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600" style="background-color: #D5AC5B;">
                                    Subir PDF
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                <!-- Fila de Total General -->
                <tr class="bg-gray-200 font-bold">
                    <td class="p-2 text-center" colspan="2">Total Consumo General</td>
                    <td class="p-2 text-center">{{ $totalConsumoGeneral }} kWh</td>
                    <td class="p-2"></td>
                    <td class="p-2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
