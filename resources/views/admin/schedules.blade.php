@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    @if(session('status'))
        <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl font-bold">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="p-4 bg-amber-100 text-amber-800 rounded-xl">
            <ul class="list-disc pl-5 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
            <div>
                <h3 class="text-lg font-bold text-slate-800">🕒 Horarios Académicos</h3>
                <p class="text-xs text-slate-400 mt-1">Organiza los bloques horarios de los cursos.</p>
            </div>
            <button id="btnAbrirModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all">
                + PROGRAMAR HORARIO
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b border-slate-200 text-xs font-bold text-slate-500 uppercase">
                        <th class="p-4">ID</th>
                        <th class="p-4">Curso</th>
                        <th class="p-4">Día</th>
                        <th class="p-4">Inicio</th>
                        <th class="p-4">Fin</th>
                        <th class="p-4">Salón</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-slate-700">
                    @forelse($datos as $schedule)
                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                            <td class="p-4 font-mono text-xs">{{ $schedule->id_schedule }}</td>
                            <td class="p-4 font-semibold">{{ $schedule->course->course_name ?? 'Curso eliminado' }}</td>
                            <td class="p-4">{{ \Illuminate\Support\Carbon::parse($schedule->weekday)->format('Y-m-d') }}</td>
                            <td class="p-4">{{ \Illuminate\Support\Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                            <td class="p-4">{{ \Illuminate\Support\Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                            <td class="p-4">{{ $schedule->num_salon }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button"
                                        class="btn-editar text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded-lg border border-blue-200 font-bold"
                                        data-id="{{ $schedule->id_schedule }}"
                                        data-course="{{ $schedule->id_course }}"
                                        data-weekday="{{ substr($schedule->weekday, 0, 10) }}"
                                        data-start_time="{{ substr($schedule->start_time, 11, 5) }}"
                                        data-end_time="{{ substr($schedule->end_time, 11, 5) }}"
                                        data-num_salon="{{ $schedule->num_salon }}">
                                        Editar
                                    </button>

                                    <form action="{{ route('schedules.destroy', $schedule->id_schedule) }}" method="POST" onsubmit="return confirm('¿Eliminar este horario?');" class="inline">
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
                            <td colspan="7" class="p-12 text-center text-slate-400">
                                <p class="text-sm font-bold">No hay horarios registrados.</p>
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
            <h4 class="font-bold text-slate-800" id="modalTitle">Programar nuevo horario</h4>
            <button id="btnCerrarModal" class="text-slate-400 text-xl font-bold">&times;</button>
        </div>
        <form id="scheduleForm" action="{{ route('schedules.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">Curso</label>
                <select name="id_course" id="courseSelect" required class="w-full px-3 py-2 border rounded-lg text-sm">
                    <option value="">Seleccione un curso</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id_course }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Día</label>
                    <input type="date" name="weekday" id="weekday" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Hora inicio</label>
                    <input type="time" name="start_time" id="start_time" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1">Hora fin</label>
                    <input type="time" name="end_time" id="end_time" required class="w-full px-3 py-2 border rounded-lg text-sm">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 mb-1">Salón</label>
                <input type="text" name="num_salon" id="num_salon" required class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Ej. A-201">
            </div>

            <div class="pt-4 border-t flex justify-end gap-2">
                <button type="button" id="btnCancelarModal" class="px-4 py-2 text-xs bg-slate-100 rounded-lg font-bold text-slate-600">Cancelar</button>
                <button type="submit" id="submitButton" class="px-4 py-2 text-xs bg-blue-600 text-white rounded-lg font-bold shadow-md">Guardar horario</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modalRegistro');
    const btnAbrir = document.getElementById('btnAbrirModal');
    const btnCerrar = document.getElementById('btnCerrarModal');
    const btnCancelar = document.getElementById('btnCancelarModal');
    const scheduleForm = document.getElementById('scheduleForm');
    const formMethod = document.getElementById('formMethod');
    const modalTitle = document.getElementById('modalTitle');
    const submitButton = document.getElementById('submitButton');
    const courseSelect = document.getElementById('courseSelect');
    const weekdayField = document.getElementById('weekday');
    const startTimeField = document.getElementById('start_time');
    const endTimeField = document.getElementById('end_time');
    const numSalonField = document.getElementById('num_salon');
    const updateUrlTemplate = "{{ route('schedules.update', ['id' => '__id__']) }}";

    const openModal = () => modal.classList.remove('hidden');
    const closeModal = () => {
        modal.classList.add('hidden');
        scheduleForm.action = "{{ route('schedules.store') }}";
        formMethod.value = 'POST';
        modalTitle.textContent = 'Programar nuevo horario';
        submitButton.textContent = 'Guardar horario';
        courseSelect.value = '';
        weekdayField.value = '';
        startTimeField.value = '';
        endTimeField.value = '';
        numSalonField.value = '';
    };

    btnAbrir.addEventListener('click', openModal);
    btnCerrar.addEventListener('click', closeModal);
    btnCancelar.addEventListener('click', closeModal);

    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', () => {
            const scheduleId = button.dataset.id;
            const courseId = button.dataset.course;
            const weekday = button.dataset.weekday;
            const startTime = button.dataset.start_time;
            const endTime = button.dataset.end_time;
            const numSalon = button.dataset.num_salon;

            scheduleForm.action = updateUrlTemplate.replace('__id__', scheduleId);
            formMethod.value = 'PUT';
            modalTitle.textContent = 'Editar horario';
            submitButton.textContent = 'Actualizar horario';
            courseSelect.value = courseId;
            weekdayField.value = weekday;
            startTimeField.value = startTime;
            endTimeField.value = endTime;
            numSalonField.value = numSalon;
            openModal();
        });
    });
</script>
@endsection
