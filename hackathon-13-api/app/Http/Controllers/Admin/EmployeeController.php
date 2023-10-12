<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleName;
use App\Events\EmployeeStored;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $employees = User::with(['userDetail', 'employeeDetail', 'positions'])
            ->where('role', UserRoleName::EMPLOYEE)
            ->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved all employees.',
            'data' => $employees,
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
    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        Position::findOrFail($validated['position_id'])->first();

        $validated = Arr::collapse([$validated, [
            'password' => Hash::make($validated['password']),
            'role' => UserRoleName::EMPLOYEE->value,
            'email_verified_at' => now(),
        ]]);

        $nip = $validated['nip'];
        $positionId = $validated['position_id'];

        $employee = User::create($validated);

        event(new EmployeeStored($employee, $nip, $positionId));

        return response()->json([
            'success' => true,
            'message' => 'Successfully created an employee account.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $employee = User::with(['userDetail', 'employeeDetail', 'positions'])
            ->where('role', UserRoleName::EMPLOYEE)    
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved employee data.',
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();
        $employee = User::with(['userDetail', 'employeeDetail', 'positions'])
            ->where('role', UserRoleName::EMPLOYEE)
            ->findOrFail($id);

        $employee->update($validated);
        $employee->employeeDetail()->update([
            'nip' => $validated['nip']
        ]);
        $employee->positions()->sync([$validated['position_id']]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully updated employee position data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        User::where('role', UserRoleName::EMPLOYEE)    
            ->findOrFail($id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted employee.',
        ]);
    }
}
