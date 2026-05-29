<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\schedulesResource;
use App\Models\schedules;
use App\Http\Requests\StoreschedulesRequest;
use App\Http\Requests\UpdateschedulesRequest;

class schedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = schedules::all();
        return schedulesResource::collection($schedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreschedulesRequest $request)
    {
        $schedules = schedules::create($request->validated());
        return new schedulesResource($schedules);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedules = schedules::findOrfail($id);
        return new schedulesResource($schedules);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateschedulesRequest $request, string $id)
    {
        $schedules = schedules::findOrFail($id);
        $schedules -> update($request->validated());
        return new schedulesResource($schedules);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedules = schedules::findOrFail($id);
        $schedules -> delete();
        return response()->json(null, 204);
    }
}
