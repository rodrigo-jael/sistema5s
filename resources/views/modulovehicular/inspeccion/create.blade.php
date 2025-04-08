<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold leading-tight dark:text-white">
                Crear inspección para {{ $vehiculo->nombre }}
            </h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form id="form-inspeccion" action="{{ route('inspeccion.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

                    {{-- Información general --}}
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block font-semibold mb-1">Fecha:</label>
                            <input type="date" name="fecha" required class="w-full border px-2 py-1 rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Placas:</label>
                            <p class="w-full border px-2 py-1 rounded bg-gray-100">{{ $vehiculo->placa }}</p>
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kilometraje:</label>
                            <input type="number" name="kilometraje" required class="w-full border px-2 py-1 rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Sede:</label>
                            <select name="sede" required class="w-full border px-2 py-1 rounded">
                                <option value="">Seleccionar sede...</option>
                                <option value="CEDIS">CEDIS</option>
                                <option value="HIELO">HIELO</option>
                                <option value="C21">C21</option>
                                <option value="M12">M12</option>
                                <option value="AXXA">AXXA</option>
                                <option value="42BERMON">42BERMON</option>
                                <option value="BERMON">BERMON</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Nombre del Chofer:</label>
                            <input type="text" name="chofer" required class="w-full border px-2 py-1 rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Nombre del Supervisor:</label>
                            <input type="text" name="supervisor" required class="w-full border px-2 py-1 rounded">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Nivel de Gasolina:</label>
                            <select name="nivel_gasolina" required class="w-full border px-2 py-1 rounded">
                                <option value="">Seleccionar...</option>
                                <option value="Lleno">Lleno</option>
                                <option value="3/4">3/4</option>
                                <option value="1/2">1/2</option>
                                <option value="1/4">1/4</option>
                                <option value="Vacío">Vacío</option>
                            </select>
                        </div>
                    </div>

                    {{-- Sección Luces --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Luces</h3>
                        @foreach([
                            'luces_delanteras' => 'Faros delanteros',
                            'luces_traseras' => 'Luces traseras',
                            'intermitentes' => 'Intermitentes',
                            'direccionales' => 'Direccionales'
                        ] as $name => $label)
                            <div class="mb-2">
                                <label><input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sección Visión --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Visión</h3>
                        <div class="mb-2"><label><input type="checkbox" name="espejos" value="1"> Espejos</label></div>
                        <div class="mb-2"><label><input type="checkbox" name="limpia_parabrisas" value="1"> Limpiaparabrisas</label></div>
                    </div>

                    {{-- Sección Documentos --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Documentos</h3>
                        @foreach([
                            'circulacion' => 'Tarjeta de circulación',
                            'licencia' => 'Licencia vigente',
                            'seguro' => 'Póliza de seguro'
                        ] as $name => $label)
                            <div class="mb-2">
                                <label><input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sección Niveles --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Niveles</h3>
                        @foreach([
                            'nivel_aceite' => 'Aceite',
                            'nivel_frenos' => 'Frenos',
                            'nivel_anticongelante' => 'Anticongelante'
                        ] as $name => $label)
                            <div class="mb-2">
                                <label><input type="checkbox" name="{{ $name }}" value="1"> Nivel de {{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sección Estado General --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Estado General</h3>
                        @foreach([
                            'llantas' => 'Llantas',
                            'rines' => 'Rines',
                            'cables' => 'Cables dañados',
                            'fugas' => 'Fugas visibles'
                        ] as $name => $label)
                            <div class="mb-2">
                                <label><input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}</label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Botón de envío --}}
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
                            Guardar Inspección
                        </button>
                    </div>
                </form>

                {{-- Scripts --}}
                <script>
                    // Marcar todos los checkboxes automáticamente al cargar la página
                    window.addEventListener('DOMContentLoaded', () => {
                        const checkboxes = document.querySelectorAll('#form-inspeccion input[type="checkbox"]');
                        checkboxes.forEach(checkbox => checkbox.checked = true);
                    });

                    // Validación simple en el cliente
                    document.getElementById('form-inspeccion').addEventListener('submit', function (e) {
                        const form = e.target;
                        const requiredFields = form.querySelectorAll('[required]');
                        let valid = true;

                        requiredFields.forEach(field => {
                            if (!field.value.trim()) {
                                field.classList.add('border-red-500');
                                valid = false;
                            } else {
                                field.classList.remove('border-red-500');
                            }
                        });

                        if (!valid) {
                            e.preventDefault();
                            alert('Por favor, completa todos los campos obligatorios.');
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
