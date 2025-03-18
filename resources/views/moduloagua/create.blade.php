@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Registrar Consumo de Agua</h1>

    <form action="{{ route('consumo_agua.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Fecha:</label>
            <input type="date" name="fecha" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Litros Consumidos:</label>
            <input type="number" name="litros_consumidos" class="border rounded w-full p-2" min="0" max="450" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
