<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Gestión de Matrículas</h1>
        <a href="{{ route('enrollments.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Nueva Matrícula</a>
    </div>

    @if(session('status'))
        <div class="mb-4 rounded border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">ID</th>
                <th class="border p-2">Alumno</th>
                <th class="border p-2">Curso</th>
                <th class="border p-2">Profesor</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
                <tr>
                    <td class="border p-2">{{ $enrollment->enrollments_id }}</td>
                    <td class="border p-2">{{ $enrollment->student->nombre ?? 'N/A' }}</td>
                    <td class="border p-2">{{ $enrollment->course->course_name ?? 'N/A' }}</td>
                    <td class="border p-2">{{ optional($enrollment->teacher)->nombre ?? 'Sin asignar' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center p-4">No hay matrículas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>