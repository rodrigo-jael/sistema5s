<x-app-layout>
    <body class="bg-gray-100 p-8 flex flex-col items-center relative min-h-screen">
        <!-- Imagen de fondo -->
        <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('/images/fondo.jpg');"></div>

        <h1 class="text-4xl font-bold text-purple-800 mb-8 relative z-10">Selecciona un Módulo</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
            <!-- Tarjeta para 5S -->
            <a href="{{ route('welcome') }}" class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center transition transform hover:scale-105 hover:shadow-xl">
                <img src="storage/images/5s.png" class="w-16 h-16 mb-4" alt="5S">
                <span class="text-lg font-semibold text-blue-600">Módulo 5S</span>
            </a>

            <!-- Tarjeta para Agua -->
            <a href="#" class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center transition transform hover:scale-105 hover:shadow-xl">
                <img src="storage/images/agua.png" class="w-16 h-16 mb-4" alt="Agua">
                <span class="text-lg font-semibold text-green-600">Módulo Agua</span>
            </a>

            <!-- Tarjeta para Luz -->
            <a href="#" class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-center transition transform hover:scale-105 hover:shadow-xl">
                <img src="storage/images/luz.png" class="w-16 h-16 mb-4" alt="Luz">
                <span class="text-lg font-semibold text-yellow-600">Módulo Luz</span>
            </a>
        </div>
    </body>
</x-app-layout>
