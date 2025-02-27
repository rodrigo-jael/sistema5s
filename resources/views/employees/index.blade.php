{{-- resources/views/employees/index.blade.php --}}
<ul class="mt-4 space-y-4">
    @foreach ($employees as $employee)
        <li class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $employee->foto) }}" alt="{{ $employee->name }}" class="w-16 h-16 rounded-full">
            <div>
                <h3 class="text-lg font-semibold">
                    <a href="{{ route('employees.show', $employee->id) }}" class="text-blue-600 hover:underline">{{ $employee->name }}</a>
                </h3>
                <p class="text-gray-600">{{ $employee->cumplio ? 'Cumplió con las 5S' : 'No cumplió con las 5S' }}</p>
            </div>
        </li>
    @endforeach
</ul>
