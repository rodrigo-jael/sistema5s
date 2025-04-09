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

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($vehiculo->inspecciones->isEmpty())
            <p class="text-gray-600">Este vehículo no tiene inspecciones registradas.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow text-sm text-left">
                    <thead class="bg-[#D5AC5B] dark:bg-gray-700 text-white">
                        <tr>
                            <th class="px-4 py-2">Fecha</th>
                            <th class="px-4 py-2">Kilometraje</th>
                            <th class="px-4 py-2">Documentos</th>
                            <th class="px-4 py-2">Estado General</th>
                            <th class="px-4 py-2">Sede</th>
                            <th class="px-4 py-2">Chofer</th>
                            <th class="px-4 py-2">Supervisor</th>
                            <th class="px-4 py-2">Nivel de Gasolina</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehiculo->inspecciones as $inspeccion)
                            <tr class="border-t">
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->fecha }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->kilometraje }}</td>
                                <td class="px-4 py-2">
                                    @if($inspeccion->circulacion) <div>Tarjeta de circulación</div> @endif
                                    @if($inspeccion->licencia) <div>Licencia vigente</div> @endif
                                    @if($inspeccion->seguro) <div>Póliza de seguro</div> @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($inspeccion->llantas) <div>Llantas</div> @endif
                                    @if($inspeccion->rines) <div>Rines</div> @endif
                                    @if($inspeccion->cables) <div>Cables dañados</div> @endif
                                    @if($inspeccion->fugas) <div>Fugas visibles</div> @endif
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->sede }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->chofer }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->supervisor }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $inspeccion->nivel_gasolina }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
