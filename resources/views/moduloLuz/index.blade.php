<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Energia - Bienvenida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen text-gray-800">
    <!-- Contenedor para el encabezado con el logo -->
    <div class="w-full flex justify-between items-center p-4 absolute top-0 left-0 right-0">
        <!-- Logo de la empresa en la parte superior derecha -->
        <img src="{{ asset('storage/images/logojorial.png') }}" alt="Logo de la empresa" class="w-40 h-auto ml-auto">
        
        <a href="{{ route('welcome2') }}" class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 transition duration-300" style="background-color: #D5AC5B;">
               Regresar
        </a>
    </div>

    <!-- Contenedor principal con contenido e imagen -->
    <div class="flex flex-col lg:flex-row items-center justify-between p-8 w-full max-w-6xl bg-white shadow-lg rounded-lg mt-20">
        
        <!-- Contenido del Módulo Agua -->
        <div class="w-full lg:w-2/3 p-8">
            <h1 class="text-4xl font-bold text-white-600 mb-8 text-center lg:text-left">Módulo de Energía</h1>
            <p class="text-gray-600 text-lg mb-6">
                Aquí podrás gestionar todo lo relacionado con el consumo de energia dentro del Sistema QMS.
            </p>
            <!-- Contenedor de los botones -->
            <div class="mt-6 flex justify-center lg:justify-start gap-4">
                <a href="{{ route('consumoenergia.nuevo') }}" 
                    class="text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition duration-300" 
                    style="background-color: #D5AC5B;">
                    Nuevo
                </a>
               <a href="{{ route('equipos.index') }}"  class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition duration-300" style="background-color: #D5AC5B;">
                  Iniciar Registro
               </a>            
               <a href="{{ route('consumoenergia.reportes') }}" class="bg-yellow-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition duration-300" style="background-color: #D5AC5B;">
                   Ver Reportes
               </a>                    
            </div>

        </div>

        <!-- Imagen al lado derecho -->
        <div class="w-full lg:w-1/3 flex justify-center ">
            <img src="storage/images/Energia.jpg" alt="Imagen de luz"  
            class="w-60 lg:w-80 h-auto rounded-lg shadow-md">
        </div>
    </div>

</body>
</html>
