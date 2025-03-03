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
                    
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employees.evaluation') }}">
                        @csrf
                        <!-- Campo de fecha oculto -->
                        <input type="date" name="evaluation_date" id="evaluation_date" value="{{ \Carbon\Carbon::today()->toDateString() }}" hidden>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Evaluación de 5S</h3>
                            <div class="flex items-center justify-between w-full">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    Guardar Evaluación
                                </button>
                                <a href="{{ route('welcome') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                                    Regresar
                                </a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <ul class="list-none space-y-4 mt-4">
                                @foreach ($employees as $employee)
                                    <li class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <span class="font-medium">{{ $employee->name }}</span>

                                        <div class="flex items-center space-x-4 justify-end w-full">
                                            <label class="flex items-center cumplir">
                                                <input type="radio" name="status[{{ $employee->id }}]" value="cumplio" class="cumplio">
                                                <span class="ml-2 text-green-600">✔</span>
                                            </label>
                                            <label class="flex items-center no_cumplio">
                                                <input type="radio" name="status[{{ $employee->id }}]" value="no_cumplio" class="no_cumplio">
                                                <span class="ml-2 text-red-600">✖</span>
                                            </label>
                                            <button type="button" class="editar hidden bg-yellow-500 text-white px-2 py-1 rounded">✎</button>
                                            
                                            <!-- Icono de lupa con tooltip -->
                                            <div class="relative group">
                                                <a href="{{ route('employee.view', $employee->id) }}" class="text-blue-500 hover:underline">
                                                    🔍
                                                </a>
                                                <span class="absolute bottom-full mb-1 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1">
                                                    Ver Eco-Map
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
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

        document.querySelectorAll(".cumplio, .no_cumplio").forEach(input => {
            input.addEventListener("change", function () {
                let parent = this.closest("li");
                let cumplio = parent.querySelector(".cumplio");
                let noCumplio = parent.querySelector(".no_cumplio");
                let editarButton = parent.querySelector(".editar");

                if (this.classList.contains("cumplio")) {
                    noCumplio.closest("label").classList.add("hidden");
                } else {
                    cumplio.closest("label").classList.add("hidden");
                }

                editarButton.classList.remove("hidden");
            });
        });

        document.querySelectorAll(".editar").forEach(button => {
            button.addEventListener("click", function () {
                let parent = this.closest("li");
                parent.querySelector(".cumplio").closest("label").classList.remove("hidden");
                parent.querySelector(".no_cumplio").closest("label").classList.remove("hidden");
                this.classList.add("hidden");
            });
        });
    });
    </script>
</x-app-layout>
