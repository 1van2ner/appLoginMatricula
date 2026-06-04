@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    @if(session('status'))
        <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl font-bold">
            {{ session('status') }}
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
                        <th class="p-4">DNI</th>
                        <th class="p-4">Nombre Completo</th>
                        <th class="p-4">Especialidad</th>
                        <th class="p-4">Correo</th>
                        <th class="p-4">Teléfono</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700">
                    @forelse($teachers as $teacher)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="p-4 font-mono text-xs">{{ $teacher->dni }}</td>
                            <td class="p-4 font-semibold">{{ $teacher->nombre }} {{ $teacher->apellidos }}</td>
                            <td class="p-4">{{ $teacher->especialidad ?? 'General' }}</td>
                            <td class="p-4 text-slate-500">{{ $teacher->email }}</td>
                            <td class="p-4 text-slate-500">{{ $teacher->telefono ?? '—' }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button" 
                                        class="btn-editar text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-lg border border-blue-200 font-bold"
                                        data-id="{{ $teacher->id_profesor }}"
                                        data-nombre="{{ $teacher->nombre }}"
                                        data-apellidos="{{ $teacher->apellidos }}"
                                        data-dni="{{ $teacher->dni }}"
                                        data-email="{{ $teacher->email }}"
                                        data-telefono="{{ $teacher->telefono }}"
                                        data-especialidad="{{ $teacher->especialidad }}">
                                        Editar
                                    </button>

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
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                <p class="text-sm font-bold">No hay profesores registrados en la base de datos.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalRegistro" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-lg overflow-hidden">
        <div class="p-4 border-b bg-slate-50 flex justify-between items-center">
            <h4 class="font-bold text-slate-800">Registrar Nuevo Docente</h4>
            <button id="btnCerrarModal" class="text-slate-400 text-xl font-bold">&times;</button>
        </div>
        <form action="{{ route('teachers.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Nombres</label>
                    <input type="text" name="nombre" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Apellidos</label>
                    <input type="text" name="apellidos" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">DNI</label>
                    <input type="text" name="dni" required maxlength="8" class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Especialidad</label>
                    <input type="text" name="especialidad" class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">Teléfono</label>
                <input type="text" name="telefono" class="w-full px-3 py-2 border rounded-lg text-sm">
            </div>
            <div class="pt-4 border-t flex justify-end gap-2">
                <button type="button" id="btnCancelarModal" class="px-4 py-2 text-xs bg-slate-100 rounded-lg font-bold text-slate-600">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-xs bg-blue-600 text-white rounded-lg font-bold shadow-md">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modalRegistro');
    const btnAbrir = document.getElementById('btnAbrirModal');
    const btnCerrar = document.getElementById('btnCerrarModal');
    const btnCancelar = document.getElementById('btnCancelarModal');

    btnAbrir.addEventListener('click', () => modal.classList.remove('hidden'));
    
    const ocultarModal = () => modal.classList.add('hidden');
    btnCerrar.addEventListener('click', ocultarModal);
    btnCancelar.addEventListener('click', ocultarModal);
</script>
@endsection