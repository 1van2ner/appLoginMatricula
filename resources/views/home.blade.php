@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <span class="fw-bold">{{ __('Dashboard - Gestión de Alumnos') }}</span>
                    <button type="button" class="btn btn-light btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalCrearAlumno">
                        + Registrar Alumno
                    </button>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>DNI</th>
                                    <th>Nombre Completo</th>
                                    <th>Fec. Nacimiento</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $student->id_alumno }}</td>
                                        <td class="fw-bold">{{ $student->dni }}</td>
                                        <td>{{ $student->nombre }} {{ $student->apellidos }}</td>
                                        <td>{{ $student->fecha_nacimiento }}</td>
                                        <td>{{ $student->telefono ?? '-' }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge {{ $student->estado_matricula === 'matriculado' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($student->estado_matricula) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditarAlumno{{ $student->id_alumno }}">
                                                Editar
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalEditarAlumno{{ $student->id_alumno }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg text-start">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title fw-bold">Editar Alumno: {{ $student->nombre }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('students.update', $student->id_alumno) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Nombre</label>
                                                                <input type="text" name="nombre" class="form-control" value="{{ $student->nombre }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Apellidos</label>
                                                                <input type="text" name="apellidos" class="form-control" value="{{ $student->apellidos }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">DNI</label>
                                                                <input type="text" name="dni" class="form-control" value="{{ $student->dni }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">Fecha de Nacimiento</label>
                                                                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $student->fecha_nacimiento }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">Teléfono</label>
                                                                <input type="text" name="telefono" class="form-control" value="{{ $student->telefono }}">
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label">Estado de Matrícula</label>
                                                                <select name="estado_matricula" class="form-select" required>
                                                                    <option value="matriculado" {{ $student->estado_matricula === 'matriculado' ? 'selected' : '' }}>Matriculado</option>
                                                                    <option value="inactivo" {{ $student->estado_matricula === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label">Dirección</label>
                                                                <input type="text" name="direccion" class="form-control" value="{{ $student->direccion }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No hay alumnos registrados actualmente.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCrearAlumno" tabindex="-1" aria-labelledby="modalCrearAlumnoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalCrearAlumnoLabel">Registrar Nuevo Alumno</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-body text-start">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej. Juan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" placeholder="Ej. Pérez Gómez" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">DNI</label>
                            <input type="text" name="dni" class="form-control" placeholder="8 dígitos" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej. 987654321">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Estado de Matrícula</label>
                            <select name="estado_matricula" class="form-select" required>
                                <option value="" selected disabled>Seleccionar...</option>
                                <option value="matriculado">Matriculado</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" placeholder="Av. Las Magnolias 123">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Registrar Alumno</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection