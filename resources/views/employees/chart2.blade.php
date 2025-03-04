<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gráfica de Evaluación 5S') }}
        </h2>
    </x-slot>

    <div class="py-12 flex flex-col items-center">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex flex-col items-center">
                
                <!-- Mover el botón "Regresar" aquí -->
                <a href="{{ route('employees.index') }}" class="mb-6 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Regresar
                </a>

                <h3 class="text-lg font-semibold mb-4">Resultados del {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h3>

                <div class="w-full flex justify-center space-x-8">
                    <div class="bg-green-200 text-green-800 p-4 rounded-lg">
                        <p class="text-xl font-bold">{{ $cumplioPorcentaje }}%</p>
                        <p>Cumplieron</p>
                    </div>
                    <div class="bg-red-200 text-red-800 p-4 rounded-lg">
                        <p class="text-xl font-bold">{{ $noCumplioPorcentaje }}%</p>
                        <p>No Cumplieron</p>
                    </div>
                </div>

                <!-- Gráfica de Pastel -->
                <div class="mt-8 w-full">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Cumplió', 'No Cumplió'],
                datasets: [{
                    data: [{{ $cumplio }}, {{ $noCumplio }}],
                    backgroundColor: ['#4caf50', '#f44336'],
                    borderColor: ['#fff', '#fff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
