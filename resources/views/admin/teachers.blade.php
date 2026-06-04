@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- Notificaciones --}}
    @if(session('status'))
        <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl font-bold">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="p-4 bg-rose-100 text-rose-800 rounded-xl font-bold">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="p-4 bg-amber-100 text-amber-800 rounded-xl">
            <ul class="list-disc pl-5 text-sm"> @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h3 class="text-lg font-bold text-slate-800">👨‍🏫 Profesores Registrados</h3>
                <p class="text-xs text-slate-400 mt-1">Gestión interna de docentes del sistema.</p>
            </div>
            <button id="btnAbrirModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all">
                + REGISTRAR PROFESOR
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nombre Completo</th>
                        <th class="p-4">Especialidad</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700">
                    @forelse($teachers as $teacher)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="p-4 font-mono text-xs">{{ $teacher->id_profesor }}</td>
                            <td class="p-4 font-semibold">{{ $teacher->nombre }} {{ $teacher->apellidos }}</td>
                            <td class="p-4">{{ $teacher->especialidad ?? 'General' }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Botón Editar --}}
                                    <button type="button"
                                        class="btn-editar text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-lg border border-blue-200 font-bold"
                                        data-id="{{ $teacher->id_profesor }}"
                                        data-nombre="{{ $teacher->nombre }}"
                                        data-apellidos="{{ $teacher->apellidos }}"
                                        data-especialidad="{{ $teacher->especialidad }}">
                                        Editar
                                    </button>

                                    {{-- Botón Eliminar --}}
                                    <form action="{{ route('teachers.destroy', $teacher->id_profesor) }}" method="POST" onsubmit="return confirm('¿Eliminar profesor?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs bg-rose-50 text-rose-600 px-3 py-1 rounded-lg border border-rose-200 font-bold">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center text-slate-400">
                                <p class="text-sm font-bold">No hay profesores registrados.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL REGISTRO --}}
<div id="modalRegistro" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <h4 class="font-bold text-slate-800 mb-4">Registrar Nuevo Docente</h4>
        <form action="{{ route('teachers.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre" required class="w-full px-3 py-2 border rounded-lg text-sm">
                <input type="text" name="apellidos" placeholder="Apellidos" required class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
            <input type="text" name="especialidad" placeholder="Especialidad" class="w-full px-3 py-2 border rounded-lg text-sm">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modalRegistro').classList.add('hidden')" class="px-4 py-2 bg-slate-100 rounded-lg text-xs font-bold">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-bold">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDICIÓN --}}
<div id="modalEditar" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <h4 class="font-bold text-slate-800 mb-4">Editar Profesor</h4>
        <form id="formEditar" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="nombre" id="edit_nombre" required class="w-full px-3 py-2 border rounded-lg text-sm">
                <input type="text" name="apellidos" id="edit_apellidos" required class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
            <input type="text" name="especialidad" id="edit_especialidad" class="w-full px-3 py-2 border rounded-lg text-sm">
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('modalEditar').classList.add('hidden')" class="px-4 py-2 bg-slate-100 rounded-lg text-xs font-bold">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-bold">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Lógica para Abrir Modal Registro
    document.getElementById('btnAbrirModal').addEventListener('click', () => {
        document.getElementById('modalRegistro').classList.remove('hidden');
    });

    // Lógica para Abrir Modal Edición y cargar datos
    document.querySelectorAll('.btn-editar').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('edit_nombre').value = btn.dataset.nombre;
            document.getElementById('edit_apellidos').value = btn.dataset.apellidos;
            document.getElementById('edit_especialidad').value = btn.dataset.especialidad;
            document.getElementById('formEditar').action = `/teachers/${btn.dataset.id}`;
            document.getElementById('modalEditar').classList.remove('hidden');
        });
    });
</script>
@endsection