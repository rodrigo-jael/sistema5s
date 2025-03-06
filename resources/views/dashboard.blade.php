<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Empleados - Evaluación 5S') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if (session('error') || session('success'))
                        <div class="p-4 rounded-md mb-4 {{ session('error') ? 'bg-red-500' : 'bg-green-500' }} text-white">
                            {{ session('error') ?? session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employees.evaluation') }}">
                        @csrf
                        <input type="date" name="evaluation_date" id="evaluation_date" value="{{ \Carbon\Carbon::today()->toDateString() }}" hidden>

                        <div class="mt-4 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Evaluación de 5S</h3>
                            <div>
                                @if(count($employees) > 0)
                                    <button type="submit" id="guardar-btn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                        Guardar Evaluación
                                    </button>
                                @endif
                                <a href="{{ route('welcome') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                    Regresar
                                </a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <ul id="employee-list" class="list-none space-y-4 mt-4">
                                @forelse ($employees as $employee)
                                    <li data-id="{{ $employee->id }}" class="employee-item flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <span class="font-medium">{{ $employee->name }}</span>
                                        <div class="flex items-center space-x-4">
                                            <label class="flex items-center">
                                                <input type="radio" name="status[{{ $employee->id }}]" value="cumplio">
                                                <span class="ml-2 text-green-600">✔</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" name="status[{{ $employee->id }}]" value="no_cumplio">
                                                <span class="ml-2 text-red-600">✖</span>
                                            </label>

                                            <!-- Lupa con Tooltip -->
                                            <div class="relative group">
                                                <a href="{{ route('employee.view', $employee->id) }}" class="text-blue-500 text-xl hover:scale-110 transition-transform">
                                                    🔍
                                                </a>
                                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                    Ver Eco-Map
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center text-gray-500">Todos los empleados ya han sido evaluados hoy.</li>
                                @endforelse
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("evaluation_date").value = new Date().toISOString().split("T")[0];

        document.querySelector("form").addEventListener("submit", function () {
            document.querySelectorAll(".employee-item input:checked").forEach(input => {
                input.closest(".employee-item").remove();
            });

            // Verifica si aún hay empleados después de eliminar los seleccionados
            if (document.querySelectorAll(".employee-item").length === 0) {
                document.getElementById("employee-list").innerHTML = '<li class="text-center text-gray-500">Todos los empleados ya han sido evaluados hoy.</li>';
                document.getElementById("guardar-btn").style.display = "none"; // Oculta el botón
            }
        });
    });
    </script>
</x-app-layout>
