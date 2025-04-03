<x-app-layout>
<x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Agregar Vehiculo</h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
        <form action="{{ route('vehiculos.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de la Unidad</label>
                <input type="text" id="nombre" name="nombre" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#D5AC5B]" required>
            </div>

            <div>
                <label for="placa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Placa</label>
                <input type="text" id="placa" name="placa" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#D5AC5B]" required>
            </div>

            <div>
                <label for="combustible" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Combustible</label>
                <select id="combustible" name="combustible" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#D5AC5B]" required>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diésel">Diésel</option>
                    <option value="Eléctrico">Eléctrico</option>
                    <option value="Híbrido">Híbrido</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-[#D5AC5B] text-black px-6 py-2 rounded-md shadow-md hover:bg-[#b9944e]">
                    Guardar Vehículo
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
