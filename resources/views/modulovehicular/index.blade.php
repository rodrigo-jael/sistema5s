<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Binevenido al Modulo vehicular</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white dark:bg-gray-800  flex flex-col items-center justify-center min-h-screen text-gray-800">
    <!-- Contenedor para el encabezado con el logo -->
    <div class="w-full flex justify-between items-center p-4 absolute top-0 left-0 right-0">
        <!-- Logo de la empresa en la parte superior derecha -->
        <img src="{{ asset('storage/images/logojorial.png') }}" alt="Logo de la empresa" class="w-40 h-auto ml-auto">

        <a href="{{ route('welcome2') }}" class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md transition duration-300">
               Regresar
        </a>

    </div>

    <!-- Contenedor principal -->
    <div class="relative w-full max-w-5xl bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 flex flex-col md:flex-row items-center mt-20">
        <!-- Contenido de bienvenida -->
        <div class="md:w-1/2 text-center md:text-left">
            <h1 class="text-4xl font-bold text-black">Modulo Vehicular</h1>
                        
            <p class="text-gray-600 mt-4 bg-white dark:bg-gray-800 ">
            Gestiona y optimiza el control de los vehículos de tu empresa, llevando un registro detallado de mantenimiento, uso y disponibilidad para garantizar un mejor rendimiento y seguridad.
            </p>
            <div class="mt-6 flex flex-col sm:flex-row sm:space-x-4 gap-4 justify-center md:justify-start">
                <a href="{{ route('vehiculos.create') }}" class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md  duration-300 w-full sm:w-auto text-center">
                    Vehiculos 
                </a>
                <a href="{{ route('inspeccion.index') }}" class="bg-[#D5AC5B] text-black px-6 py-3 rounded-md shadow-md  duration-300 w-full sm:w-auto text-center">
                     Inspeccion 
                </a>
                <a href="{{ route('reportes.index') }}" class="bg-[#D5AC5B] text-black  px-6 py-3 rounded-md shadow-md  duration-300 w-full sm:w-auto text-center">
                     Destinos 
                 </a>
            </div>
        </div>
        
        <!-- Imagen -->
        <div class="md:w-1/2 flex justify-center mt-6 md:mt-0">
            <img src="https://www.carroceriaspanamericana.com/wp-content/uploads/2023/08/transporte-de-carga-1024x546.png" alt="Metodología 5S" class="rounded-lg shadow-md w-full max-w-sm">
        </div>
    </div>

    
</body>
</html>
