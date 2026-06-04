@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-2xl mx-auto">
    <h3 class="text-lg font-bold mb-4">Agregar Curso</h3>

    <form action="{{ route('courses.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Nombre</label>
            <input name="course_name" type="text" required class="mt-1 block w-full border rounded p-2" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Código</label>
            <input name="course_code" type="text" class="mt-1 block w-full border rounded p-2" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Créditos</label>
            <input name="credits" type="number" class="mt-1 block w-full border rounded p-2" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" class="mt-1 block w-full border rounded p-2" rows="3"></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('courses.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Guardar</button>
        </div>
    </form>
</div>
@endsection
