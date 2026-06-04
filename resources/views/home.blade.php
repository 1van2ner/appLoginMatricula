@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-slate-900 to-blue-900 p-8 rounded-2xl shadow-lg border border-slate-800 text-white">
        <h2 class="text-2xl font-bold">¡Bienvenido al Sistema de Matrícula Académica!</h2>
        <p class="text-blue-200 mt-2 text-sm max-w-xl">
            Has ingresado correctamente al panel administrativo del instituto. Desde el menú lateral izquierdo puedes gestionar todas las operaciones de la base de datos de manera modular.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="text-2xl mb-2">👥</div>
            <h4 class="font-bold text-gray-900 text-base">Gestión de Alumnos</h4>
            <p class="text-xs text-gray-500 mt-1 mb-4">Inscripciones, edición de datos personales y estados fiscales.</p>
            <a href="{{ url('/admin/students') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ir al módulo &rarr;
            </a>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="text-2xl mb-2">👨‍🏫</div>
            <h4 class="font-bold text-gray-900 text-base">Panel de Profesores</h4>
            <p class="text-xs text-gray-500 mt-1 mb-4">Administración del cuerpo docente y asignación de materias.</p>
            <a href="{{ url('/admin/teachers') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ir al módulo &rarr;
            </a>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="text-2xl mb-2">📚</div>
            <h4 class="font-bold text-gray-900 text-base">Catálogo de Cursos</h4>
            <p class="text-xs text-gray-500 mt-1 mb-4">Mapeo de asignaturas curriculares y prerrequisitos del año.</p>
            <a href="{{ url('/admin/courses') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ir al módulo &rarr;
            </a>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="text-2xl mb-2">📝</div>
            <h4 class="font-bold text-gray-900 text-base">Matrículas Activas</h4>
            <p class="text-xs text-gray-500 mt-1 mb-4">Control de registros escolares activos y auditoría de procesos.</p>
            <a href="{{ url('/admin/enrollments/create') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ir al registro &rarr;
            </a>
        </div>

        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition">
            <div class="text-2xl mb-2">🕒</div>
            <h4 class="font-bold text-gray-900 text-base">Configuración de Horarios</h4>
            <p class="text-xs text-gray-500 mt-1 mb-4">Define días, bloques y salones para los cursos del semestre.</p>
            <a href="{{ url('/admin/schedules') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                Ir al módulo &rarr;
            </a>
        </div>
    </div>
</div>
@endsection