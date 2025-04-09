<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo Energia - Bienvenida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 flex flex-col items-center justify-center min-h-screen text-gray-800 dark:text-gray-100">

    <!-- Encabezado con el logo y botón -->
    <div class="w-full flex justify-between items-center p-4 absolute top-0 left-0 right-0">
        <!-- Logo -->
        <img src="{{ asset('storage/images/logojorial.png') }}" alt="Logo de la empresa" class="w-40 h-auto ml-auto">

        <!-- Botón regresar -->
        <a href="{{ route('welcome2') }}"
           class="px-6 py-3 rounded-md shadow-md text-white hover:bg-red-700 transition duration-300"
           style="background-color: #D5AC5B;">
            Regresar
        </a>
    </div>

    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row items-center justify-between p-8 w-full max-w-6xl bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-20">

        <!-- Texto -->
        <div class="w-full lg:w-2/3 p-8">
            <h1 class="text-4xl font-bold mb-8 text-center lg:text-left text-gray-800 dark:text-white">
                Módulo de Energía
            </h1>
            <p class="text-gray-700 dark:text-gray-300 text-lg mb-6">
                Aquí podrás gestionar todo lo relacionado con el consumo de energía dentro del Sistema QMS.
            </p>

            <!-- Botones -->
            <div class="mt-6 flex justify-center lg:justify-start gap-4">
                
                <a href="{{ route('equipos.index') }}"
                   class="text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition duration-300"
                   style="background-color: #D5AC5B;">
                    Equipo
                </a>

                <a href="{{ route('consumoenergia.reportes') }}"
                   class="text-white px-6 py-3 rounded-md shadow-md hover:bg-yellow-700 transition duration-300"
                   style="background-color: #D5AC5B;">
                    Reportes
                </a>
            </div>
        </div>

        <!-- Imagen -->
        <div class="w-full lg:w-1/3 flex justify-center">
            <img src="{{ asset('storage/equipos/Energia.jpg') }}" alt="Imagen de luz"
                 class="w-60 lg:w-80 h-auto rounded-lg shadow-md">
        </div>
    </div>

</body>
</html>
