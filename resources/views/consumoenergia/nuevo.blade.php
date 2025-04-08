<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Registro del Equipo</h2>
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

                    <h3 class="text-lg font-semibold mb-4 text-[#D5AC5B]">Registro de Chequeo</h3>

                    @include('equipos.modal')

                    <div class="container mx-auto p-6">
                        <h2 class="text-xl font-bold mb-4 dark:text-white">Nuevo Registro de Consumo de Energía</h2>
                        
                        <form action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            
                            <div class="mb-4">
                                <label for="ubicacion" class="block font-medium dark:text-gray-300">Ubicación</label>
                                <select id="ubicacion" name="ubicacion"
                                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1">
                                    <option value="">Seleccione una ubicación</option>
                                    <option value="Oficina">OFICINA</option>
                                    <option value="Almacen 1">ALMACEN 1</option>
                                    <option value="Almacen 2">ALMACEN 2</option>
                                    <option value="Almacen 3">ALMACEN 3</option>
                                    <option value="Baño">BAÑO</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="nombre" class="block font-medium dark:text-gray-300">Equipo</label>
                                <input type="text" id="nombre" name="nombre"
                                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1 uppercase"
                                       placeholder="Ingrese el equipo en MAYÚSCULAS"
                                       oninput="this.value = this.value.toUpperCase();">
                            </div>

                            <div class="mb-4">
                                <label for="consumo" class="block font-medium dark:text-gray-300">Consumo (kWh)</label>
                                <input type="number" id="consumo" name="consumo"
                                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1"
                                       step="0.01">
                            </div>

                            <div class="mb-4">
                                <label for="imagen" class="block font-medium dark:text-gray-300">Seleccionar Imagen</label>
                                <input type="file" id="imagen" name="imagen"
                                       class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded mt-1"
                                       accept="image/*">
                            </div>

                            <button type="submit"
                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#equipo').select2({
                placeholder: "Seleccione un equipo",
                allowClear: true,
                width: '100%',
                dropdownAutoWidth: true,
                dropdownParent: $('#equipo').parent(),
                dropdownCssClass: 'custom-select2-dropdown'
            });
        });
    </script>

    <style>
        .custom-select2-dropdown {
            max-height: 300px;
            overflow-y: auto;
        }

        /* Soporte dark mode para select2 dropdown */
        .select2-container--default .select2-results > .select2-results__options {
            background-color: #1f2937; /* gray-800 */
            color: #f3f4f6; /* gray-100 */
        }
        .select2-container--default .select2-selection--single {
            background-color: #374151; /* gray-700 */
            color: #f3f4f6;
            border-color: #4b5563; /* gray-600 */
        }
    </style>
</x-app-layout>
