<?php

namespace App\Http\Controllers;

use App\Models\schedules; // O 'Schedule' según tu archivo de modelo
use App\Http\Requests\StoreschedulesRequest;
use App\Http\Requests\UpdateschedulesRequest;
use Illuminate\Http\Request;

class SchedulesWebController extends Controller
{
    public function index()
    {
        // Al igual que matrícula, puedes traer la relación del curso asignado al horario
        $datos = schedules::with('course')->orderBy('id_schedule', 'desc')->get();
        return view('admin.schedules', compact('datos'));
    }

    public function store(StoreschedulesRequest $request)
    {
        schedules::create($request->validated());

        return redirect()->route('schedules.index')->with('status', '¡Horario académico programado!');
    }

    public function update(UpdateschedulesRequest $request, $id)
    {
        $schedule = schedules::findOrFail($id);
        $schedule->update($request->validated());

        return redirect()->route('schedules.index')->with('status', '¡Horario escolar modificado con éxito!');
    }
}