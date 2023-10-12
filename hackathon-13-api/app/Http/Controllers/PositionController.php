<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreEmployeePositionRequest;
use App\Http\Requests\Admin\UpdateEmployeePositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $employeePositions = Position::paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all employee positions.',
            'data' => $employeePositions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeePositionRequest $request): JsonResponse
    {
        Position::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Successfully created an employee position.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved employee position data.',
            'employee_position' => $position,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeePositionRequest $request, Position $position): JsonResponse
    {
        $position->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated employee position data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position): JsonResponse
    {
        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted employee position.',
        ]);
    }
}
