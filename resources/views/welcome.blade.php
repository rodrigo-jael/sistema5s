<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Las 5S - Bienvenida</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen text-gray-800">
    <!-- Contenedor para el encabezado con el logo -->
    <div class="w-full flex justify-between items-center p-4 absolute top-0 left-0 right-0">
        <!-- Logo de la empresa en la parte superior derecha -->
        <img src="{{ asset('storage/images/logojorial.png') }}" alt="Logo de la empresa" class="w-40 h-auto ml-auto">
    </div>

    <!-- Contenedor principal -->
    <div class="relative w-full max-w-5xl bg-white shadow-lg rounded-lg p-8 flex flex-col md:flex-row items-center mt-20">
        <!-- Contenido de bienvenida -->
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl font-bold text-purple-700">BIENVENIDO</h1>
            <p class="text-yellow-500 text-lg font-semibold mt-2">Metodología 5S</p>
            <p class="text-gray-600 mt-4">
                Optimiza tu entorno de trabajo aplicando la metodología 5S para mejorar la eficiencia y organización.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row sm:space-x-4 gap-4 justify-center md:justify-start">
                <a href="/login" class="bg-purple-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-purple-700 transition duration-300 w-full sm:w-auto text-center">
                    Iniciar Registro 
                </a>
                <a href="/grafica" class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition duration-300 w-full sm:w-auto text-center">
                     Ver Evaluaciones
                </a>
                <a href="{{ route('reportes.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition duration-300 w-full sm:w-auto text-center">
                     Ver Reportes
                 </a>
            </div>
        </div>
        
        <!-- Imagen -->
        <div class="md:w-1/2 flex justify-center mt-6 md:mt-0">
            <img src="https://envira.es/wp-content/uploads/2024/01/Metodologia-5S.jpg" alt="Metodología 5S" class="rounded-lg shadow-md w-full max-w-sm">
        </div>
    </div>
</body>
</html>
