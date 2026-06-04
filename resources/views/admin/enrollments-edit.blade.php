@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-3xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Editar Matrícula</h3>
            <p class="text-sm text-gray-500">Actualiza los datos de la matrícula.</p>
        </div>
        <a href="{{ route('enrollments.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Volver</a>
    </div>

    <form action="{{ route('enrollments.update', $enrollment->id_enrollment) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="rounded border border-red-200 bg-red-50 p-4 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Alumno</label>
            <select name="id_alumno" required class="mt-1 block w-full border rounded p-2">
                <option value="">Selecciona un alumno</option>
                @foreach($students as $student)
                    <option value="{{ $student->id_alumno }}" {{ $enrollment->id_alumno == $student->id_alumno ? 'selected' : '' }}>{{ $student->nombre }} {{ $student->apellidos }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Curso</label>
            <select name="id_course" required class="mt-1 block w-full border rounded p-2">
                <option value="">Selecciona un curso</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id_course }}" {{ $enrollment->id_course == $course->id_course ? 'selected' : '' }}>{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Profesor (opcional)</label>
            <select name="id_teacher" class="mt-1 block w-full border rounded p-2">
                <option value="">Sin profesor</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id_profesor }}" {{ $enrollment->id_teacher == $teacher->id_profesor ? 'selected' : '' }}>{{ $teacher->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Horario (opcional)</label>
            <select name="id_schedule" class="mt-1 block w-full border rounded p-2">
                <option value="">Sin horario</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id_schedule }}" {{ $enrollment->id_schedule == $schedule->id_schedule ? 'selected' : '' }}>Horario {{ $schedule->id_schedule }} - {{ $schedule->weekday }} {{ $schedule->start_time }} - {{ $schedule->end_time }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Semestre</label>
                <input name="semester" type="text" required value="{{ $enrollment->semester }}" class="mt-1 block w-full border rounded p-2" placeholder="2026-1" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha de matrícula</label>
                <input name="enrollment_date" type="date" required value="{{ $enrollment->enrollment_date }}" class="mt-1 block w-full border rounded p-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nota final (opcional)</label>
                <input name="final_grade" type="number" step="0.01" min="0" max="20" value="{{ $enrollment->final_grade }}" class="mt-1 block w-full border rounded p-2" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" required class="mt-1 block w-full border rounded p-2">
                    <option value="approved" {{ $enrollment->status == 'approved' ? 'selected' : '' }}>Aprobado</option>
                    <option value="failed" {{ $enrollment->status == 'failed' ? 'selected' : '' }}>Reprobado</option>
                    <option value="ongoing" {{ $enrollment->status == 'ongoing' ? 'selected' : '' }}>Cursando</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('enrollments.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Actualizar matrícula</button>
        </div>
    </form>
</div>
@endsection
