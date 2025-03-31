<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-b from-white to-gray-200">
    <div class="bg-white shadow-lg rounded-2xl p-6 w-80 text-center relative">
        
        <!-- Estilo superior decorativo -->
        
        <!-- Logo -->
        <img src="{{ asset('storage/images/qms.png') }}" alt="QMS Logo" class="w-16 mx-auto mb-4 relative z-10">

        <h2 class="text-lg font-semibold text-gray-700">INICIAR SESIÓN</h2>
        <p class="text-sm text-gray-500 mb-4">BIENVENIDO, INTRODUCE TUS CREDENCIALES</p>
        
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <!-- Email -->
            <div class="text-left">
                <label for="email" class="block text-sm font-medium text-gray-600">Correo Electrónico</label>
                <input id="email" type="email" name="email" required autofocus 
                    class="w-full p-2 border-b border-gray-300 focus:outline-none focus:border-yellow-500">
            </div>

            <!-- Contraseña -->
            <div class="text-left">
                <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                <input id="password" type="password" name="password" required 
                    class="w-full p-2 border-b border-gray-300 focus:outline-none focus:border-yellow-500">
            </div>

            <!-- Botón de Ingreso -->
            <button type="submit" class="w-full bg-[#D5AC5B]  text-white py-2 rounded-md shadow-md font-semibold">Ingresar</button>
        </form>
        
        <!-- Enlace de registro -->
        <p class="text-sm text-gray-600 mt-4">¿No tienes cuenta? 
            <a href="{{ route('register') }}" class="text-blue-500 font-semibold">Crear cuenta</a>
        </p>
    </div>
</body>
</html>
