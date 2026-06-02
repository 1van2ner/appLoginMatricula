<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollments; 
use App\Http\Requests\StoreEnrollmentsRequest;  
use App\Http\Requests\UpdateEnrollmentsRequest; 

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Enrollments::with(['student', 'course', 'teacher', 'schedule'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnrollmentsRequest $request)
    {
     
        
        return Enrollments::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Enrollments::with(['student', 'course', 'teacher', 'schedule'])->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrollmentsRequest $request, string $id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $enrollment->update($request->validated());

        return $enrollment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollments::findOrFail($id);
        $enrollment->delete();

        return $enrollment;
    }
}