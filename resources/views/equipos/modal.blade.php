<!-- Modal oculto por defecto -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md shadow-md w-1/3">
        <h2 class="text-xl font-bold mb-4">Agregar Nuevo Equipo</h2>
        
        <form id="equipoForm" action="{{ route('equipos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nombre del equipo -->
            <label class="block mb-2">Equipo:</label>
            <input type="text" name="nombre" class="w-full p-2 border rounded mb-4" required>

            <!-- Imagen -->
            <label class="block mb-2">Imagen:</label>
            <input type="file" name="imagen" class="w-full p-2 border rounded mb-4" required>

            <!-- Ubicación -->
            <label class="block mb-2">Ubicación:</label>
            <input type="text" name="ubicacion" class="w-full p-2 border rounded mb-4" required>

            <!-- Consumo -->
            <label class="block mb-2">Consumo (kWh):</label>
            <input type="decimal" name="consumo" class="w-full p-2 border rounded mb-4" required>

            <!-- Botones -->
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">
                    Cancelar
                </button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
