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
        
        <a href="{{ route('welcome2') }}" class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-red-700 transition duration-300">
               Regresar
        </a>
    </div>

   

</body>
</html>
