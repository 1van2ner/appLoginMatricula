<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * GET /api/courses
     * Listar todos los cursos.
     */
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    /**
     * POST /api/courses
     * Guardar un nuevo curso con validación.
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        
        return (new CourseResource($course))
            ->additional(['message' => 'Curso creado con éxito'])
            ->response()
            ->setStatusCode(201); // 201 Created
    }

    /**
     * GET /api/courses/{id}
     * Mostrar un curso específico por su ID.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404); // Error 404 Not Found
        }

        return new CourseResource($course);
    }

    /**
     * PUT /api/courses/{id}
     * Actualizar un curso existente.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        // Validación rápida en línea para el método Update
        $validated = $request->validate([
            'course_name' => 'sometimes|string|max:150',
            'course_code' => 'sometimes|string|max:20|unique:courses,course_code,' . $id . ',id_course',
            'credits'     => 'sometimes|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $course->update($validated);

        return (new CourseResource($course))
            ->additional(['message' => 'Curso actualizado con éxito'])
            ->response()
            ->setStatusCode(200); // 200 OK
    }

    /**
     * DELETE /api/courses/{id}
     * Eliminar un curso de la base de datos.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Curso no encontrado'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Curso eliminado con éxito'], 200);
    }
}