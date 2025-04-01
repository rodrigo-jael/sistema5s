<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Gestion Diaria de Equipos</h2>
            <a href="{{ route('luz.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if (session('success'))
                        <div class="p-4 rounded-md mb-4 bg-green-500 text-white">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4" style="color: #D5AC5B">Registro de Chequeo</h3>
                    <div class="flex justify-between mb-4">
                        <a href="#" onclick="openModal()" 
                            class="text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition duration-300" 
                            style="background-color: #D5AC5B;">
                            Nuevo
                        </a>
                    </div>
                    @include('equipos.modal')

                    <form method="POST" action="{{ route('equipos.updateDias') }}">
                        @csrf

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead style="background-color: #D5AC5B;">
                                    <tr class="text-center">
                                        <th class="border p-2">Equipo</th>
                                        <th class="border p-2">Imagen</th>
                                        <th class="border p-2">Ubicación</th>
                                        <th class="border p-2">Consumo (kWh)</th>
                                        <th class="border p-2">Lun</th>
                                        <th class="border p-2">Mar</th>
                                        <th class="border p-2">Mié</th>
                                        <th class="border p-2">Jue</th>
                                        <th class="border p-2">Vie</th>
                                        <th class="border p-2">Sáb</th>
                                        <th class="border p-2">Días Encendidos</th>
                                        <th class="border p-2">Consumo Total</th>
                                        <th class="border p-2">Acciones</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($equipos as $equipo)
                                        <tr class="text-center">
                                            <td class="border p-2">{{ $equipo->nombre }}</td>
                                            <td class="border p-2">
                                                @if ($equipo->imagen)
                                                    <img src="{{ asset('storage/' . $equipo->imagen) }}" width="100">
                                                @else
                                                    Sin imagen
                                                @endif
                                            </td>
                                            <td class="border p-2">{{ $equipo->ubicacion }}</td>
                                            <td class="border p-2">{{ $equipo->consumo_promedio }} kWh</td>

                                            @php
                                                $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];
                                            @endphp

                                            @foreach($dias as $dia)
                                                <td class="border p-2">
                                                    <input type="checkbox" name="dias[{{ $equipo->id }}][{{ $dia }}]" 
                                                           value="1" {{ $equipo->$dia ? 'checked' : '' }}>
                                                </td>
                                            @endforeach

                                            <td class="border p-2">{{ $equipo->dias_utilizados }}</td>
                                            <td class="border p-2">{{ $equipo->consumo_total }} kWh</td>

                                            <td class="border p-2">
                                                <a href="{{ route('equipos.eliminar', $equipo->id) }}" 
                                                   class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600" 
                                                   onclick="return confirm('¿Estás seguro de eliminar este equipo?');">
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" style="background-color: #D5AC5B;">
                                Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
