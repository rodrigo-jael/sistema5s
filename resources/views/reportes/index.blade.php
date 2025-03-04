<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes 5S</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <!-- Botón para regresar al welcome -->
    <div class="mb-4">
        <a href="{{ url('/welcome') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-700 transition duration-300">
            ← Regresar al Inicio
        </a>
    </div>

    <h1 class="text-3xl font-bold text-center mb-4 text-purple-700">Reportes de Evaluación 5S</h1>

    <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Resumen General</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div class="bg-blue-500 text-white p-4 rounded-lg">
                <p class="text-lg font-semibold">Total Evaluaciones</p>
                <p class="text-2xl font-bold">{{ $totalEvaluaciones }}</p>
            </div>
            <div class="bg-green-500 text-white p-4 rounded-lg">
                <p class="text-lg font-semibold">Cumplió</p>
                <p class="text-2xl font-bold">{{ $totalCumplio }}</p>
                <p class="text-sm">{{ $porcentajeCumplio }}%</p>
            </div>
            <div class="bg-red-500 text-white p-4 rounded-lg">
                <p class="text-lg font-semibold">No Cumplió</p>
                <p class="text-2xl font-bold">{{ $totalNoCumplio }}</p>
                <p class="text-sm">{{ $porcentajeNoCumplio }}%</p>
            </div>
        </div>

        <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-4">Empleado Más Destacado</h2>
        <p class="text-lg text-center text-purple-700 font-bold">{{ $empleadoMasCumplidor }}</p>

        <!-- Botón para exportar a Excel -->
        <div class="mt-6 text-center">
            <a href="{{ route('reportes.export') }}" 
               class="bg-purple-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-purple-600 transition duration-300">
                Exportar a Excel
            </a>
        </div>

    </div>
</body>
</html>
