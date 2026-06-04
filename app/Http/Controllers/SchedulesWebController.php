<?php

namespace App\Http\Controllers;

use App\Models\schedules;
use App\Models\Course;
use App\Http\Requests\StoreschedulesRequest;
use App\Http\Requests\UpdateschedulesRequest;
use Illuminate\Http\Request;

class SchedulesWebController extends Controller
{
    public function index()
    {
        $datos = schedules::with('course')->orderBy('id_schedule', 'desc')->get();
        $courses = Course::orderBy('course_name')->get();

        return view('admin.schedules', compact('datos', 'courses'));
    }

    public function store(StoreschedulesRequest $request)
    {
        $data = $request->validated();
        $date = $data['weekday'];
        $data['weekday'] = $date . ' 00:00:00';
        $data['start_time'] = $date . ' ' . $data['start_time'] . ':00';
        $data['end_time'] = $date . ' ' . $data['end_time'] . ':00';

        schedules::create($data);

        return redirect()->route('schedules.index')->with('status', '¡Horario académico programado!');
    }

    public function update(UpdateschedulesRequest $request, $id)
    {
        $schedule = schedules::findOrFail($id);
        $data = $request->validated();
        $date = $data['weekday'];
        $data['weekday'] = $date . ' 00:00:00';
        $data['start_time'] = $date . ' ' . $data['start_time'] . ':00';
        $data['end_time'] = $date . ' ' . $data['end_time'] . ':00';

        $schedule->update($data);

        return redirect()->route('schedules.index')->with('status', '¡Horario escolar modificado con éxito!');
    }

    public function destroy($id)
    {
        $schedule = schedules::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('status', '¡Horario eliminado correctamente!');
    }
}