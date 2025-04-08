<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Gestión Diaria de Energía</h2>
            <a href="{{ route('luz.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded hover:bg-yellow-600 transition">
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

                    <h3 class="text-lg font-semibold mb-4 text-[#D5AC5B]">Registro</h3>

                    <!-- Menú Desplegable para Filtrar por Ubicación -->
                    <div class="mb-4 flex items-center">
                        <label for="filtroUbicacion" class="mr-2 font-semibold text-lg dark:text-white">Filtrar por Ubicación:</label>
                        <select id="filtroUbicacion"
                                class="border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="todos">Todos</option>
                            @foreach($equipos->pluck('ubicacion')->unique() as $ubicacion)
                                <option value="{{ $ubicacion }}">{{ $ubicacion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <form method="POST" action="{{ route('equipos.updateDias') }}">
                        @csrf
                        @method('POST')

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                                <thead style="background-color: #D5AC5B;" class="text-black">
                                    <tr class="text-center">
                                        <th class="border p-2 dark:border-gray-600">Equipo</th>
                                        <th class="border p-2 dark:border-gray-600">Imagen</th>
                                        <th class="border p-2 dark:border-gray-600">Ubicación</th>
                                        <th class="border p-2 dark:border-gray-600">Consumo (kWh)</th>
                                        <th class="border p-2 dark:border-gray-600">Lun</th>
                                        <th class="border p-2 dark:border-gray-600">Mar</th>
                                        <th class="border p-2 dark:border-gray-600">Mié</th>
                                        <th class="border p-2 dark:border-gray-600">Jue</th>
                                        <th class="border p-2 dark:border-gray-600">Vie</th>
                                        <th class="border p-2 dark:border-gray-600">Sáb</th>
                                        <th class="border p-2 dark:border-gray-600">Días Encendidos</th>
                                        <th class="border p-2 dark:border-gray-600">Horas Encendido</th>
                                        <th class="border p-2 dark:border-gray-600">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody id="tablaEquipos" class="bg-white dark:bg-gray-700">
                                    @foreach($equipos as $equipo)
                                        <tr class="text-center fila-equipo border dark:border-gray-600" data-ubicacion="{{ $equipo->ubicacion }}">
                                            <td class="border p-2 dark:border-gray-600">{{ $equipo->nombre }}</td>
                                            <td class="border p-2 dark:border-gray-600">
                                                @if ($equipo->imagen)
                                                    <img src="{{ asset('storage/' . $equipo->imagen) }}" width="100">
                                                @else
                                                    <span class="text-gray-500 dark:text-gray-300">Sin imagen</span>
                                                @endif
                                            </td>

                                            <td class="border p-2 dark:border-gray-600">{{ $equipo->ubicacion }}</td>
                                            <td class="border p-2 dark:border-gray-600">{{ $equipo->consumo_promedio }} kWh</td>

                                            @foreach($dias as $dia)
                                            <td class="border p-2 dark:border-gray-600">
                                                <input type="checkbox"
                                                       name="dias[{{ $equipo->id }}][{{ $dia }}]" 
                                                       value="1"
                                                       {{ $equipo->$dia ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                        

                                            <td class="border p-2 dark:border-gray-600">{{ $equipo->dias_utilizados }}</td>
                                            <td class="border p-2 dark:border-gray-600">{{ $equipo->horas_encendido }} hrs</td>

                                            <td class="border p-2 dark:border-gray-600 space-y-1">
                                             {{-- Botón Editar con modal --}}
                                              <button
                                                    type="button"
                                                    class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition"
                                                    onclick="editarEquipo({{ $equipo->id }}, '{{ $equipo->ubicacion }}', '{{ $equipo->nombre }}', '{{ $equipo->consumo_promedio }}')">
                                                    Editar
                                               </button>
                                         

                                                

                                                <a href="{{ route('equipos.eliminar', $equipo->id) }}"
                                                   class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition"
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
                            <button type="submit"
                                    class="bg-[#D5AC5B] text-black px-4 py-2 rounded-md hover:bg-yellow-600 transition font-bold">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

                <!-- Modal de Edición -->
                <div id="modalEditar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
                        <h2 class="text-xl font-semibold mb-4 text-[#D5AC5B]">Editar Equipo</h2>
                        <form id="formEditar" method="POST" action="{{ route('equipos.actualizar') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="edit_id" name="id">

                            <div class="mb-4">
                                <label for="edit_ubicacion" class="block font-medium dark:text-gray-300">Ubicación</label>
                                <select id="edit_ubicacion" name="ubicacion" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1">
                                    <option value="Oficina">OFICINA</option>
                                    <option value="Almacen 1">ALMACEN 1</option>
                                    <option value="Almacen 2">ALMACEN 2</option>
                                    <option value="Almacen 3">ALMACEN 3</option>
                                    <option value="Baño">BAÑO</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="edit_nombre" class="block font-medium dark:text-gray-300">Equipo</label>
                                <input type="text" id="edit_nombre" name="nombre"
                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1 uppercase"
                                    oninput="this.value = this.value.toUpperCase();">
                            </div>

                            <div class="mb-4">
                                <label for="edit_consumo" class="block font-medium dark:text-gray-300">Consumo (kWh)</label>
                                <input type="number" id="edit_consumo" name="consumo"
                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1"
                                    step="0.01">
                            </div>

                            <div class="mb-4">
                                <label for="edit_imagen" class="block font-medium dark:text-gray-300">Actualizar Imagen</label>
                                <input type="file" id="edit_imagen" name="imagen"
                                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1"
                                    accept="image/*">
                            </div>

                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="cerrarModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Cancelar</button>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Script Modal -->
                <script>
                    function editarEquipo(id, ubicacion, nombre, consumo) {
                        document.getElementById('edit_id').value = id;
                        document.getElementById('edit_ubicacion').value = ubicacion;
                        document.getElementById('edit_nombre').value = nombre;
                        document.getElementById('edit_consumo').value = consumo;

                        document.getElementById('modalEditar').classList.remove('hidden');
                    }

                    function cerrarModal() {
                        document.getElementById('modalEditar').classList.add('hidden');
                    }
                </script>



    <!-- Script para Filtrar -->
    <script>
        document.getElementById('filtroUbicacion').addEventListener('change', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('.fila-equipo');

            filas.forEach(fila => {
                let ubicacion = fila.getAttribute('data-ubicacion').toLowerCase();
                fila.style.display = (filtro === "todos" || ubicacion === filtro) ? "" : "none";
            });
        });
    </script>
</x-app-layout>
