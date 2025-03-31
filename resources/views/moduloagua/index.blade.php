<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Las 5S - Bienvenida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white-100 flex flex-col items-center justify-center min-h-screen text-gray-800">
    <!-- Contenedor para el encabezado con el logo -->
    <div class="w-full flex justify-between items-center p-4 absolute top-0 left-0 right-0">
        <!-- Logo de la empresa en la parte superior derecha -->
        <img src="{{ asset('storage/images/logojorial.png') }}" alt="Logo de la empresa" class="w-40 h-auto absolute top-4 left-4">
        
        <a href="{{ route('welcome2') }}" class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md text-center transition duration-300 w-40 h-auto ml-auto">
            Regresar
        </a>
    </div>

    <!-- Contenedor principal con contenido e imagen -->
    <div class="flex flex-col lg:flex-row items-center justify-between p-8 w-full max-w-6xl bg-white shadow-lg rounded-lg mt-20">
        
        <!-- Contenido del Módulo Agua -->
        <div class="w-full lg:w-2/3 p-8">
            <h1 class="text-4xl font-bold text-black mb-8 text-center lg:text-left">Módulo del Agua</h1>
            <p class="text-gray-600 text-lg mb-6">
                Aquí podrás gestionar todo lo relacionado con el consumo y ahorro de agua dentro del Sistema QMS.
            </p>

            <!-- Botones para Acciones -->
            <div class="mt-6 flex flex-col lg:flex-row gap-4 justify-center lg:justify-start">
                <!-- Botón para Iniciar Registro -->
                <a href="{{ route('consumo_agua.index2') }}" 
                   class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md transition duration-300 flex items-center gap-2">
                     Iniciar Registro
                </a>

                <!-- Botón para Ver Reportes -->
                <a href="{{ route('consumo_agua.show') }}" 
                   class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md transition duration-300 flex items-center gap-2">
                    Ver Reportes
                </a>
            </div>
        </div>

        <!-- Imagen al lado derecho -->
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="https://www.ecoportal.net/wp-content/uploads/2023/04/agua-en-casa-jpg.webp" 
                 alt="Imagen de agua" class="w-60 lg:w-80 h-auto rounded-lg shadow-md">
        </div>
    </div>

</body>
</html>
