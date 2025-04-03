<!-- resources/views/inspeccion/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Nueva Inspección Vehicular</h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Registrar Inspección Vehicular</h2>

                <!-- Formulario de inspección -->
                <form action="{{ route('inspeccion.store') }}" method="POST">
                    @csrf

                    <!-- Campos del formulario -->
                    <div class="mb-4">
                        <h4 class="font-semibold">Luces</h4>
                        <label class="block">Faro principal delantero (alta y baja)</label>
                        <select name="luces_faro" class="mt-2 w-full border-gray-300 rounded-md">
                            <option value="Sin detección">Sin detección</option>
                            <option value="Con detección">Con detección</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Faros de niebla</label>
                        <select name="luces_niebla" class="mt-2 w-full border-gray-300 rounded-md">
                            <option value="Sin detección">Sin detección</option>
                            <option value="Con detección">Con detección</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>

                    <!-- Agregar más campos aquí -->

                    <!-- Botones de acción -->
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('vehicular.index') }}" class="bg-gray-400 text-white px-6 py-2 rounded-md mr-2">Cancelar</a>
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
