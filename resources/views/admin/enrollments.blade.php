@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-slate-50">
            <div>
                <h3 class="text-lg font-bold text-slate-800">Gestión de Matrículas</h3>
                <p class="text-sm text-slate-500 mt-1">Revisa, edita o elimina los registros de matrícula activos.</p>
            </div>
            <a href="{{ route('enrollments.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold uppercase tracking-wide hover:bg-blue-700 transition">
                + Nueva Matrícula
            </a>
        </div>

        <div class="p-6">
            @if(session('status'))
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wide font-semibold">
                            <th class="p-4 border-b border-slate-200">ID</th>
                            <th class="p-4 border-b border-slate-200">Alumno</th>
                            <th class="p-4 border-b border-slate-200">Curso</th>
                            <th class="p-4 border-b border-slate-200">Profesor</th>
                            <th class="p-4 border-b border-slate-200">Semestre</th>
                            <th class="p-4 border-b border-slate-200">Fecha</th>
                            <th class="p-4 border-b border-slate-200">Estado</th>
                            <th class="p-4 border-b border-slate-200 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-700">
                        @forelse($enrollments as $enrollment)
                            <tr class="border-b border-slate-100 hover:bg-slate-50">
                                <td class="p-4 font-mono text-xs">{{ $enrollment->id_enrollment }}</td>
                                <td class="p-4 font-semibold">{{ $enrollment->student->nombre ?? 'N/A' }} {{ $enrollment->student->apellidos ?? '' }}</td>
                                <td class="p-4">{{ $enrollment->course->course_name ?? 'N/A' }}</td>
                                <td class="p-4">{{ optional($enrollment->teacher)->nombre ?? 'Sin asignar' }}</td>
                                <td class="p-4">{{ $enrollment->semester }}</td>
                                <td class="p-4">{{ \Illuminate\Support\Carbon::parse($enrollment->enrollment_date)->format('Y-m-d') }}</td>
                                <td class="p-4">{{ ucfirst($enrollment->status) }}</td>
                                <td class="p-4 text-center">
                                    <div class="inline-flex items-center gap-2">
                                        <a href="{{ route('enrollments.edit', $enrollment->id_enrollment) }}" class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-xs font-semibold border border-blue-100 hover:bg-blue-100">Editar</a>
                                        <form action="{{ route('enrollments.destroy', $enrollment->id_enrollment) }}" method="POST" onsubmit="return confirm('¿Eliminar esta matrícula?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 rounded-lg bg-rose-50 text-rose-600 text-xs font-semibold border border-rose-100 hover:bg-rose-100">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-12 text-center text-slate-400">No hay matrículas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
