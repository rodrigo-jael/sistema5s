<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">
                Inspecciones de {{ $vehiculo->nombre }}
            </h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        @if($vehiculo->inspecciones->isEmpty())
            <p class="text-gray-600">Este vehículo no tiene inspecciones registradas.</p>
        @else
            <table class="w-full table-auto bg-white rounded shadow">
                <thead class="bg-[#D5AC5B] dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-white">Fecha</th>
                        <th class="px-4 py-2 text-white">Kilometraje</th>
                        <th class="px-4 py-2 text-white">Documentos</th>
                        <th class="px-4 py-2 text-white">Estado General</th>
                        <th class="px-4 py-2 text-white">Sede</th>
                        <th class="px-4 py-2 text-white">Chofer</th>
                        <th class="px-4 py-2 text-white">Supervisor</th>
                        <th class="px-4 py-2 text-white">Nivel de Gasolina</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculo->inspecciones as $inspeccion)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $inspeccion->fecha }}</td>
                            <td class="px-4 py-2">{{ $inspeccion->kilometraje }}</td>
                            <td class="px-4 py-2">
                                @if($inspeccion->circulacion) Tarjeta de circulación @endif
                                @if($inspeccion->licencia) Licencia vigente @endif
                                @if($inspeccion->seguro) Póliza de seguro @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($inspeccion->llantas) Llantas @endif
                                @if($inspeccion->rines) Rines @endif
                                @if($inspeccion->cables) Cables dañados @endif
                                @if($inspeccion->fugas) Fugas visibles @endif
                            </td>
                            <td class="px-4 py-2">{{ $inspeccion->sede }}</td>
                            <td class="px-4 py-2">{{ $inspeccion->chofer }}</td>
                            <td class="px-4 py-2">{{ $inspeccion->supervisor }}</td>
                            <td class="px-4 py-2">{{ $inspeccion->nivel_gasolina }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
