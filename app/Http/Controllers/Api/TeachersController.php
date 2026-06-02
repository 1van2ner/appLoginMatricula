<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher; // 
use App\Http\Requests\StoreTeachersRequest; 
use App\Http\Resources\TeachersResource;   

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TeachersResource::collection(Teacher::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachersRequest $request)
    {
        $teacher = Teacher::create($request->validated());

        return new TeachersResource($teacher);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        return new TeachersResource($teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeachersRequest $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->validated());

        return new TeachersResource($teacher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return new TeachersResource($teacher);
    }
}