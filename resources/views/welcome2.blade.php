<x-app-layout>
    <x-slot name="header">
        <h2 class="text-[#D5AC5B] dark:bg-gray-800 leading-tight text-center">
            {{ __('Herramientas ') }}
        </h2>
    </x-slot>

    <body class="bg-gray-100 p-8 flex flex-col items-center relative min-h-screen">
        <!-- Imagen de fondo -->
        <div class="absolute inset-0 bg-cover bg-center opacity-30 pointer-events-none" style="background-image: url('/images/fondo.jpg');"></div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10 mt-12">

            <!-- Tarjeta para 5S -->
            <a href="{{ route('welcome') }}" class="bg-[#f8f4ec] p-6 rounded-lg shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105 hover:shadow-xl text-center">
                <img src="storage/images/5s.png" class="w-16 h-16 mb-4" alt="5S">
                <span class="text-lg font-semibold text-[#D5AC5B]">Control de gestion 5S</span>
            </a>

            <!-- Tarjeta para Agua -->
            <a href="{{ route('agua.index') }}" class="bg-[#f8f4ec] p-6 rounded-lg shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105 hover:shadow-xl text-center">
                <img src="storage/images/agua.png" class="w-16 h-16 mb-4" alt="Agua">
                <span class="text-lg font-semibold text-[#D5AC5B]">Control del consumo de Agua</span>
            </a>

            <!-- Tarjeta para Luz -->
            <a href="{{ route('luz.index') }}" class="bg-[#f8f4ec] p-6 rounded-lg shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105 hover:shadow-xl text-center">
                <img src="storage/images/luz.png" class="w-16 h-16 mb-4" alt="Luz">
                <span class="text-lg font-semibold text-[#D5AC5B]">Control del consumo de Electricidad</span>
            </a>

            <!-- Tarjeta para Vehículos -->
            <a href="{{ route('vehicular.index') }}" class="bg-[#f8f4ec] p-6 rounded-lg shadow-lg flex flex-col items-center justify-center transition transform hover:scale-105 hover:shadow-xl text-center">
                <img src="storage/images/vehicular.png" class="w-16 h-16 mb-4" alt="Vehículos">
                <span class="text-lg font-semibold text-[#D5AC5B]">Control Vehicular</span>
            </a>
        </div>
    </body>
</x-app-layout>
