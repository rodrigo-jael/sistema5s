<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-center" style="color: #D5AC5B;">
            {{ __('Gestión Diaria de Equipos') }}
        </h2>
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
                        <a href="{{ route('luz.index') }}" 
                           class="text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition duration-300" 
                           style="background-color: #D5AC5B;">
                            Regresar
                        </a>
                    </div>

                    @include('equipos.modal')

                    <div class="container mx-auto p-6">
                        <h2 class="text-xl font-bold mb-4">Nuevo Registro de Consumo de Energía</h2>
                        
                        <form action="{{ route('consumoenergia.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
                            @csrf

                            <div class="mb-4">
                                <label for="equipo" class="block font-medium">Equipo</label>
                                <select id="equipo" name="equipo" class="w-full border-gray-300 rounded mt-1">
                                    <option value="">Seleccione un equipo</option>
                                    @foreach([
                                        "Monitor de 17 pulg",
                                        "CPU Hp Mini torre fuente de 500",
                                        "Laptop Hp 14 pulg",
                                        "Foco Led Lznipw",
                                        "Monitor de 24 pulg",
                                        "Impresora epson 1",
                                        "Cargador de celular",
                                        "CPU torre fuente de 500",
                                        "Lampara Led 1",
                                        "Lampara Led 2",
                                        "Television hisense 32 pulg",
                                        "Impresora epson 2",
                                        "Monitor Samsumg 19 pulg",
                                        "Lampara de escritorio 3d",
                                        "Regulador No-Break 5416",
                                        "Telefono Inalambrico Motorola",
                                        "Cargador Inalambrico",
                                        "Multicontacto",
                                        "Monitor Samsumg 24 pulg",
                                        "Lampara de escritorio flexible plata 40 w",
                                        "Lampara de tubo lineal 1",
                                        "Lampara de tubo lineal 2",
                                        "Camara de vigilancia Netvision 1",
                                        "Camara de vigilancia Netvision 2",
                                        "Pantalla Sony 40 pulgadas",
                                        "Extencion electrica 3 contacts",
                                        "Laptop lenovo 14 pulg",
                                        "Tablet 10 pulg",
                                        "Tablet Apple 10 pulg",
                                        "Laptop Acer 19 pulg",
                                        "Telefono Inalambrico Motorola 2",
                                        "Multicontacto 8 entradas volteck mul-8",
                                        "Impresora de etiquetas codex G500",
                                        "Bocina Bluetooth ludico Mic S0602",
                                        "Zkteco Checador k40",
                                        "Multicontacto 6 entradas Koblenz"
                                    ] as $equipo)
                                        <option value="{{ $equipo }}">{{ $equipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="imagen" class="block font-medium">Imagen</label>
                                <input type="file" id="imagen" name="imagen" class="w-full border-gray-300 rounded mt-1">
                            </div>
                    
                            <div class="mb-4">
                                <label for="ubicacion" class="block font-medium">Ubicación</label>
                                <select id="ubicacion" name="ubicacion" class="w-full border-gray-300 rounded mt-1">
                                    <option value="">Seleccione una ubicación</option>
                                    <option value="Planta A">Planta A</option>
                                    <option value="Planta B">Planta B</option>
                                </select>
                            </div>
                    
                            <div class="mb-4">
                                <label for="consumo" class="block font-medium">Consumo (kWh)</label>
                                <input type="number" id="consumo" name="consumo" class="w-full border-gray-300 rounded mt-1">
                            </div>
                    
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Guardar
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Agregamos Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            $('#equipo').select2({
                placeholder: "Seleccione un equipo",
                allowClear: true,
                width: '100%',
                dropdownAutoWidth: true,   // Asegura que el dropdown ocupe el ancho correcto
                dropdownParent: $('#equipo').parent(), // Hace que se despliegue correctamente dentro del contenedor
                dropdownCssClass: 'custom-select2-dropdown' // Puedes aplicar estilos adicionales aquí
            });
        });
    </script>

    <style>
        /* Personaliza el dropdown para que se muestre hacia abajo */
        .custom-select2-dropdown {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>

</x-app-layout>
