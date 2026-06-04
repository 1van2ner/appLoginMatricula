@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-xl font-bold text-gray-900">Catálogo de Cursos</h3>
            <p class="text-sm text-gray-500 mt-1">Administración de las materias del sistema académico.</p>
        </div>
        <a href="{{ route('courses.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow transition">
            + Agregar Registro
        </a>
    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 font-semibold">ID</th>
                    <th class="px-6 py-4 font-semibold">Nombre / Descripción</th>
                    <th class="px-6 py-4 font-semibold">Estado</th>
                    <th class="px-6 py-4 font-semibold text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($datos as $registro)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="px-6 py-4 font-mono text-gray-900">{{ $registro->id_course }}</td>
                        <td class="px-6 py-4 text-gray-900 font-medium">{{ $registro->course_name ?? $registro->description }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Activo
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2 items-center">
                                <a href="{{ route('courses.edit', $registro->id_course) }}" class="text-blue-600 hover:text-blue-800 font-medium px-2 py-1 rounded hover:bg-blue-50 transition">Editar</a>

                                <form action="{{ route('courses.destroy', $registro->id_course) }}" method="POST" onsubmit="return confirm('¿Eliminar este curso?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium px-2 py-1 rounded hover:bg-red-50 transition">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <span class="text-3xl">📂</span>
                                <p class="text-sm font-medium">No se encontraron registros en esta tabla.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection