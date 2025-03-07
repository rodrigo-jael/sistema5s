
<x-app-layout>
    <body class="bg-gray-100 p-8 flex flex-col items-center">
        <h1 class="text-3xl font-bold text-purple-700 mb-6">Selecciona un Módulo</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Botón para 5S -->
            <a href="{{ route('welcome') }}" 
                class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-blue-600 transition">
                Módulo 5S
            </a>
            
            <!-- Botón para Agua -->
            <a href="#" 
                class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-green-600 transition">
                Módulo Agua
            </a>
            
            <!-- Botón para Luz -->
            <a href="#" 
                class="bg-yellow-500 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-yellow-600 transition">
                Módulo Luz
            </a>
        </div>
    </body>
</x-app-layout>
