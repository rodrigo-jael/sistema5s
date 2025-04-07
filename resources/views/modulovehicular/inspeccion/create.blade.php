<x-app-layout>
<x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">
                Crear inspeccion para  {{ $vehiculo->nombre }}
            </h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('inspeccion.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">

                    <div class="mb-4">
                        <label>Fecha:</label>
                        <input type="date" name="fecha" class="w-full border px-2 py-1 rounded">
                    </div>

                    <div class="mb-4">
                        <label>Placas:</label>
                        <p class="w-full border px-2 py-1 rounded bg-gray-100">{{ $vehiculo->placa }}</p>
                    </div>

                    <div class="mb-4">
                        <label>Kilometraje:</label>
                        <input type="number" name="kilometraje" class="w-full border px-2 py-1 rounded">
                    </div>

                    <div class="mb-4">
                        <label>Sede:</label>
                        <select name="sede" class="w-full border px-2 py-1 rounded">
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


                    <div class="mb-4">
                         <label>Nombre del Chofer:</label>
                         <input type="text" name="chofer" class="w-full border px-2 py-1 rounded">
                    </div>

                    <div class="mb-4">
                        <label>Nombre del Supervisor:</label>
                        <input type="text" name="supervisor" class="w-full border px-2 py-1 rounded">
                    </div>

                    <div class="mb-4">
                        <label>Nivel de Gasolina:</label>
                        <select name="nivel_gasolina" class="w-full border px-2 py-1 rounded">
                                <option value="">Seleccionar...</option>
                                <option value="Lleno">Lleno</option>
                                <option value="3/4">3/4</option>
                                <option value="1/2">1/2</option>
                                <option value="1/4">1/4</option>
                                <option value="Vacío">Vacío</option>
                        </select>
                    </div>


                    <h3 class="font-bold mt-6">Luces</h3>
                    @foreach(['luces_delanteras' => 'Faros delanteros', 'luces_traseras' => 'Luces traseras', 'intermitentes' => 'Intermitentes', 'direccionales' => 'Direccionales'] as $name => $label)
                        <div class="mb-2">
                            <label>
                                <input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}
                            </label>
                        </div>
                    @endforeach

                    <h3 class="font-bold mt-6">Visión</h3>
                    <div class="mb-2"><label><input type="checkbox" name="espejos" value="1"> Espejos</label></div>
                    <div class="mb-2"><label><input type="checkbox" name="limpia_parabrisas" value="1"> Limpiaparabrisas</label></div>

                    <h3 class="font-bold mt-6">Documentos</h3>
                    @foreach(['circulacion' => 'Tarjeta de circulación', 'licencia' => 'Licencia vigente', 'seguro' => 'Póliza de seguro'] as $name => $label)
                        <div class="mb-2">
                            <label><input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}</label>
                        </div>
                    @endforeach

                    <h3 class="font-bold mt-6">Niveles</h3>
                    @foreach(['nivel_aceite' => 'Aceite', 'nivel_frenos' => 'Frenos', 'nivel_anticongelante' => 'Anticongelante'] as $name => $label)
                        <div class="mb-2">
                            <label><input type="checkbox" name="{{ $name }}" value="1"> Nivel de {{ $label }}</label>
                        </div>
                    @endforeach

                    <h3 class="font-bold mt-6">Estado General</h3>
                    @foreach(['llantas' => 'Llantas', 'rines' => 'Rines', 'cables' => 'Cables dañados', 'fugas' => 'Fugas visibles'] as $name => $label)
                        <div class="mb-2">
                            <label><input type="checkbox" name="{{ $name }}" value="1"> {{ $label }}</label>
                        </div>
                    @endforeach

                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                            Guardar Inspección
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
