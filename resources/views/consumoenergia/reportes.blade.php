<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Historial Bimestral de Consumo y Huella de Carbono
            </h2>
            <a href="{{ route('luz.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ←Regresar
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">

                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div x-data="{ open: false }"> <!-- Ahora este div envuelve el botón y el modal -->
            <!-- Título y botón para abrir el modal -->
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold" style="color: #D5AC5B;">
                    Reportes Bimestrales de Huella de Carbono
                </h1>

                <!-- Botón para abrir el modal -->
                <button @click="open = true" class="bg-yellow-600 text-white px-6 py-3 rounded-md hover:bg-yellow-700 transition">
                    Registrar Nuevo Reporte
                </button>
            </div>

            <!-- Modal -->
                <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-md w-1/2">
                        <h2 class="text-xl font-bold mb-4 text-[#D5AC5B] dark:text-yellow-300">
                            Registrar Nuevo Consumo Bimestral
                        </h2>

                        <!-- Formulario dentro del modal -->
                        <form action="{{ route('consumoenergia.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-2 gap-4">
                                <!-- Fecha de inicio -->
                                <div>
                                    <label class="block text-gray-700 dark:text-gray-200">Fecha de inicio del periodo:</label>
                                    <input type="date" name="fecha_inicio" required class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                </div>

                                <!-- Fecha de fin -->
                                <div>
                                    <label class="block text-gray-700 dark:text-gray-200">Fecha de fin del periodo:</label>
                                    <input type="date" name="fecha_fin" required class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                </div>

                                <!-- Consumo de energía -->
                                <div>
                                    <label class="block text-gray-700 dark:text-gray-200">Consumo (kWh):</label>
                                    <input type="number" name="kwh_consumidos" step="0.01" required class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                </div>

                                <!-- Subir PDF del recibo -->
                                <div class="col-span-2">
                                    <label class="block text-gray-700 dark:text-gray-200">Subir recibo en PDF (opcional):</label>
                                    <input type="file" name="pdf_recibo" accept="application/pdf" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                </div>
                            </div>

                            <!-- Botones en el modal -->
                            <div class="flex justify-between w-full mt-4">
                                <button type="button" @click="open = false" class="bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700 transition w-1/3">
                                    Cancelar
                                </button>
                                <button type="submit" class="bg-green-600 text-white text-sm px-6 py-2 rounded hover:bg-green-700 transition w-1/3">
                                    Guardar Registro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


        <!-- Tabla de registros -->
        <table class="w-full bg-white dark:bg-gray-800 shadow-md rounded text-gray-800 dark:text-gray-100">

            <thead style="background-color: #D5AC5B; color: white;">
                <tr>
                    <th class="p-2">Periodo Facturado</th>
             
                    <th class="p-2">Consumo (kWh)</th>
                    <th class="p-2">Huella de Carbono (Kg CO₂)</th>
                    <th class="p-2">PDF</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consumos as $consumo)
                
                <tr class="border-b">
                    <td class="p-2">
                        {{ strtoupper(\Carbon\Carbon::parse($consumo->fecha_inicio)->locale('es')->translatedFormat('d M y')) }}
                        -
                        {{ strtoupper(\Carbon\Carbon::parse($consumo->fecha_fin)->locale('es')->translatedFormat('d M y')) }}
                    </td>
                    
                 
                    <td class="p2">{{$consumo->kwh_consumidos}}</td>
                    <td class="p-2">
                        {{ number_format($consumo->kwh_consumidos * 0.444) }} {{-- Factor CO2 --}}
                    </td>
                    <td class="p-2 flex justify-center">
                        @if($consumo->pdf_recibo)
                            <a href="{{ asset('storage/' . $consumo->pdf_recibo) }}" 
                               target="_blank"
                               class="text-white px-3 py-1 rounded-md hover:bg-blue-600" 
                               style="background-color: #D5AC5B;">
                                Ver PDF
                            </a>
                        @else
                            <form action="{{ route('consumoenergia.subirRecibo', $consumo->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                                @csrf
                                <input type="file" name="pdf_recibo" accept="application/pdf" required class="text-sm border rounded px-2 py-1">
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    Subir
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="border p-2">
                        
                        <form action="{{ route('consumoenergia.destroy', $consumo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta fila?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white text-sm px-2 py-1 rounded hover:bg-red-700 transition">
                                Eliminar Registro
                            </button>
                        </form>
                        

                        @foreach ($consumos as $reporte)
                            <!-- Botón de editar por cada reporte -->
                            <div x-data="{ openEdit{{ $reporte->id }}: false }">
                                <button @click="openEdit{{ $reporte->id }} = true" class="bg-green-600 text-white text-sm px-6 py-1 rounded hover:bg-green-700 transition">
                                    Editar
                                </button>

                                <!-- Modal por cada reporte -->
                                <div x-show="openEdit{{ $reporte->id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow w-1/2">
                                        <h2 class="text-xl font-bold mb-4 text-blue-600 dark:text-yellow-400">Editar Reporte</h2>

                                        <form action="{{ route('consumoenergia.update', $reporte->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-gray-700 dark:text-gray-200">Fecha inicio:</label>
                                                    <input type="date" name="fecha_inicio" value="{{ $reporte->fecha_inicio }}" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                                </div>
                                                <div>
                                                    <label class="block text-gray-700 dark:text-gray-200">Fecha fin:</label>
                                                    <input type="date" name="fecha_fin" value="{{ $reporte->fecha_fin }}" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                                </div>
                                                <div>
                                                    <label class="block text-gray-700 dark:text-gray-200">Consumo (kWh):</label>
                                                    <input type="number" step="0.01" name="kwh_consumidos" value="{{ $reporte->kwh_consumidos }}" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block text-gray-700 dark:text-gray-200">Actualizar PDF (opcional):</label>
                                                    <input type="file" name="pdf_recibo" accept="application/pdf" class="w-full p-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                                                </div>
                                            </div>

                                            <div class="flex justify-between mt-4">
                                                <button type="button" @click="openEdit{{ $reporte->id }} = false" class="bg-red-600 text-white text-sm px-4 py-2 rounded hover:bg-red-700 transition">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition">
                                                    Guardar Cambios
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        
                        
                    </td>
                </tr>
                @endforeach

                
                <!-- Fila de Total General -->
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 font-bold">
                    <td class="p-2 text-center" colspan="2">Total General</td>
                
                    <td class="p-2 text-center">{{ number_format($totalConsumoGeneral * 0.444) }} Kg CO₂</td>
                    <td class="p-2"></td>
                    <td class="p-2"></td>

                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
