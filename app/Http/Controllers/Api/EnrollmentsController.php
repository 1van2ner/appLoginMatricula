<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollments; 
use App\Http\Requests\StoreEnrollmentsRequest;  
use App\Http\Requests\UpdateEnrollmentsRequest; 

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource (Listar todas las matrículas).
     */
    public function index()
    {
    
        $enrollments = Enrollments::with(['student', 'course', 'teacher', 'schedule'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $enrollments
        ], 200);
    }

    /**
     * Store a newly created resource in storage (Crear una nueva matrícula).
     */
    public function store(StoreEnrollmentsRequest $request)
    {
        


        $exists = Enrollments::where('student_id', $request->student_id)
                            ->where('course_id', $request->course_id)
                            ->where('semester', $request->semester)
                            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'El alumno ya se encuentra matriculado en este curso para el presente semestre.'
            ], 409);
        }

        
        $enrollment = Enrollments::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Matrícula realizada con éxito',
            'data' => $enrollment
        ], 201);
    }

    /**
     * Display the specified resource (Ver una matrícula específica).
     */
    public function show(string $id)
    {
        // Recuerda que en tu modelo 'id_matricula' pasó a ser 'enrollment_id'
        $enrollment = Enrollments::with(['student', 'course', 'teacher', 'schedule'])->find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $enrollment
        ], 200);
    }

    /**
     * Update the specified resource in storage (Actualizar notas o estados).
     */
    public function update(UpdateEnrollmentsRequest $request, string $id)
    {
        $enrollment = Enrollments::find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        // Actualizamos de forma masiva y segura solo con los campos autorizados en el Update Request
        $enrollment->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Matrícula actualizada correctamente',
            'data' => $enrollment
        ], 200);
    }

    /**
     * Remove the specified resource from storage (Eliminar/Dar de baja una matrícula).
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollments::find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Matrícula no encontrada'
            ], 404);
        }

        $enrollment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Matrícula eliminada correctamente'
        ], 200);
    }
}