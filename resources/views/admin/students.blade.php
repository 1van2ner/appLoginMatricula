@extends('layouts.app')

@section('content')
<div class="space-y-6">

    @if(session('status'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-sm font-semibold flex items-center gap-3 shadow-sm animate-fade-in">
            <span class="bg-emerald-500 text-white p-1 rounded-lg text-xs">✓</span>
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-5 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-sm shadow-sm animate-fade-in">
            <div class="flex items-center gap-2.5 font-bold mb-2 text-rose-900">
                <span class="bg-rose-500 text-white px-2 py-0.5 rounded-lg text-xs">!</span>
                Por favor, corrige los errores del formulario:
            </div>
            <ul class="list-disc pl-6 space-y-1 text-xs font-medium text-rose-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        
        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span>👥</span> Alumnos Registrados
                </h3>
                <p class="text-xs font-medium text-slate-400 mt-1">Lista general y control de estados de matrícula en la base de datos.</p>
            </div>
            <button id="btnAbrirModal" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md shadow-blue-500/10 transition-all duration-200 flex items-center gap-2 tracking-wide transform hover:-translate-y-0.5">
                <span class="text-sm">+</span> REGISTRAR NUEVO ALUMNO
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/70 border-b border-slate-200/60 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        <th class="px-8 py-4">DNI / Documento</th>
                        <th class="px-8 py-4">Nombre Completo</th>
                        <th class="px-8 py-4">Correo Electrónico</th>
                        <th class="px-8 py-4">Teléfono</th>
                        <th class="px-8 py-4">Estado</th>
                        <th class="px-8 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm font-medium text-slate-700">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50/40 transition-colors duration-150">
                            <td class="px-8 py-4 font-mono text-xs text-slate-900 bg-slate-50/30">{{ $student->dni }}</td>
                            <td class="px-8 py-4 text-slate-900 font-semibold">{{ $student->nombre }} {{ $student->apellidos }}</td>
                            <td class="px-8 py-4 text-slate-500 font-normal">{{ $student->email }}</td>
                            <td class="px-8 py-4 text-slate-500 font-normal">{{ $student->telefono ?? '—' }}</td>
                            <td class="px-8 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $student->estado_matricula === 'matriculado' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : 'bg-slate-100 text-slate-600 border-slate-200' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $student->estado_matricula === 'matriculado' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    {{ ucfirst($student->estado_matricula) }}
                                </span>
                            </td>
                            <td class="px-8 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" 
                                        class="btn-editar text-xs font-bold text-blue-600 hover:text-indigo-700 bg-blue-50/50 hover:bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 transition-all"
                                        data-id="{{ $student->id_alumno ?? $student->id }}"
                                        data-nombre="{{ $student->nombre }}"
                                        data-apellidos="{{ $student->apellidos }}"
                                        data-fecha="{{ $student->fecha_nacimiento }}"
                                        data-dni="{{ $student->dni }}"
                                        data-email="{{ $student->email }}"
                                        data-telefono="{{ $student->telefono }}"
                                        data-direccion="{{ $student->direccion }}"
                                        data-estado="{{ $student->estado_matricula }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('students.destroy', $student->id_alumno ?? $student->id) }}" method="POST" onsubmit="return confirm('¿Estás completamente seguro de eliminar a este alumno? Esta acción no se puede deshacer.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold text-rose-600 hover:text-rose-700 bg-rose-50/50 hover:bg-rose-50 px-3 py-1.5 rounded-lg border border-rose-100 transition-all">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-16 text-center">
                                <div class="max-w-sm mx-auto flex flex-col items-center justify-center text-slate-400 gap-3">
                                    <span class="text-4xl bg-slate-100 p-4 rounded-2xl border border-slate-200/60">📁</span>
                                    <p class="text-sm font-bold text-slate-700 mt-2">No hay registros cargados</p>
                                    <p class="text-xs font-medium text-slate-400 leading-relaxed">La tabla se encuentra vacía. Comienza registrando un alumno mediante el botón superior.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modalRegistro" class="fixed inset-0 z-50 invisible flex items-center justify-center p-4 transition-all duration-300">
    <div id="modalFondo" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="modalContenedor">
        <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
            <div>
                <h4 class="text-base font-bold text-slate-800">Formulario de Inscripción</h4>
                <p class="text-[11px] font-medium text-slate-400 mt-0.5">Ingresa los datos del alumno para la persistencia en el sistema.</p>
            </div>
            <button id="btnCerrarModal" type="button" class="text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full hover:bg-slate-200/60 flex items-center justify-center text-lg font-medium transition">&times;</button>
        </div>
        <form action="{{ route('students.store') }}" method="POST" class="p-8 space-y-5 bg-white">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Nombres *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Apellidos *</label>
                    <input type="text" name="apellidos" value="{{ old('apellidos') }}" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Fecha de Nacimiento *</label>
                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-700 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">DNI *</label>
                    <input type="text" name="dni" value="{{ old('dni') }}" required maxlength="8" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium font-mono focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Correo *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Dirección</label>
                <input type="text" name="direccion" value="{{ old('direccion') }}" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Estado *</label>
                <select name="estado_matricula" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-700 transition-all">
                    <option value="matriculado">Matriculado Activo</option>
                    <option value="inactivo">Inactivo / Retirado</option>
                </select>
            </div>
            <div class="pt-5 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/50 -mx-8 -mb-8 p-6">
                <button type="button" id="btnCancelarModal" class="px-4 py-2.5 text-xs font-bold text-slate-500 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl shadow-sm transition-all">CANCELAR</button>
                <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md transition-all">GUARDAR REGISTRO</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdicion" class="fixed inset-0 z-50 invisible flex items-center justify-center p-4 transition-all duration-300">
    <div id="modalFondoEdit" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="modalContenedorEdit">
        <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
            <div>
                <h4 class="text-base font-bold text-slate-800">Modificar Datos del Alumno</h4>
                <p class="text-[11px] font-medium text-slate-400 mt-0.5">Actualiza los campos necesarios. Recuerda guardar los cambios.</p>
            </div>
            <button id="btnCerrarModalEdit" type="button" class="text-slate-400 hover:text-slate-600 w-8 h-8 rounded-full hover:bg-slate-200/60 flex items-center justify-center text-lg font-medium transition">&times;</button>
        </div>
        <form id="formEdicion" method="POST" class="p-8 space-y-5 bg-white">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Nombres *</label>
                    <input type="text" name="nombre" id="edit_nombre" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Apellidos *</label>
                    <input type="text" name="apellidos" id="edit_apellidos" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Fecha de Nacimiento *</label>
                    <input type="date" name="fecha_nacimiento" id="edit_fecha" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-700 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">DNI *</label>
                    <input type="text" name="dni" id="edit_dni" required maxlength="8" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium font-mono focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Correo *</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Teléfono</label>
                    <input type="text" name="telefono" id="edit_telefono" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                </div>
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Dirección</label>
                <input type="text" name="direccion" id="edit_direccion" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Estado *</label>
                <select name="estado_matricula" id="edit_estado" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 text-slate-700 transition-all">
                    <option value="matriculado">Matriculado Activo</option>
                    <option value="inactivo">Inactivo / Retirado</option>
                </select>
            </div>
            <div class="pt-5 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/50 -mx-8 -mb-8 p-6">
                <button type="button" id="btnCancelarModalEdit" class="px-4 py-2.5 text-xs font-bold text-slate-500 bg-white hover:bg-slate-100 border border-slate-200 rounded-xl shadow-sm transition-all">CANCELAR</button>
                <button type="submit" class="px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-md transition-all">ACTUALIZAR CAMBIOS</button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- LÓGICA MODAL CREAR ---
    const modalReg = document.getElementById('modalRegistro');
    const contenedorReg = document.getElementById('modalContenedor');
    const btnAbrirReg = document.getElementById('btnAbrirModal');
    const btnCerrarReg = document.getElementById('btnCerrarModal');
    const btnCancelarReg = document.getElementById('btnCancelarModal');
    const fondoReg = document.getElementById('modalFondo');

    function abrirReg() {
        modalReg.classList.remove('invisible');
        setTimeout(() => { contenedorReg.classList.remove('scale-95', 'opacity-0'); contenedorReg.classList.add('scale-100', 'opacity-100'); }, 10);
    }
    function cerrarReg() {
        contenedorReg.classList.remove('scale-100', 'opacity-100'); contenedorReg.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modalReg.classList.add('invisible'); }, 300);
    }
    btnAbrirReg.addEventListener('click', abrirReg);
    btnCerrarReg.addEventListener('click', cerrarReg);
    btnCancelarReg.addEventListener('click', cerrarReg);
    fondoReg.addEventListener('click', cerrarReg);


    // --- LÓGICA MODAL EDITAR ---
    const modalEdit = document.getElementById('modalEdicion');
    const contenedorEdit = document.getElementById('modalContenedorEdit');
    const btnCerrarEdit = document.getElementById('btnCerrarModalEdit');
    const btnCancelarEdit = document.getElementById('btnCancelarModalEdit');
    const fondoEdit = document.getElementById('modalFondoEdit');
    const formEdicion = document.getElementById('formEdicion');

    function cerrarEdit() {
        contenedorEdit.classList.remove('scale-100', 'opacity-100'); contenedorEdit.classList.add('scale-95', 'opacity-0');
        setTimeout(() => { modalEdit.classList.add('invisible'); }, 300);
    }
    btnCerrarEdit.addEventListener('click', cerrarEdit);
    btnCancelarEdit.addEventListener('click', cerrarEdit);
    fondoEdit.addEventListener('click', cerrarEdit);

    // Capturar clicks de los botones de la tabla
    document.querySelectorAll('.btn-editar').forEach(boton => {
        boton.addEventListener('click', function() {
            // Extraer la data del botón presionado
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const apellidos = this.getAttribute('data-apellidos');
            const fecha = this.getAttribute('data-fecha');
            const dni = this.getAttribute('data-dni');
            const email = this.getAttribute('data-email');
            const telefono = this.getAttribute('data-telefono');
            const direccion = this.getAttribute('data-direccion');
            const estado = this.getAttribute('data-estado');

            // Inyectar dinámicamente la URL con la ID correcta al Formulario
            formEdicion.action = `/admin/students/${id}`;

            // Rellenar inputs del Modal de Edición
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_apellidos').value = apellidos;
            document.getElementById('edit_fecha').value = fecha;
            document.getElementById('edit_dni').value = dni;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_telefono').value = telefono || '';
            document.getElementById('edit_direccion').value = direccion || '';
            document.getElementById('edit_estado').value = estado;

            // Desplegar Modal animado
            modalEdit.classList.remove('invisible');
            setTimeout(() => { contenedorEdit.classList.remove('scale-95', 'opacity-0'); contenedorEdit.classList.add('scale-100', 'opacity-100'); }, 10);
        });
    });
</script>
@endsection