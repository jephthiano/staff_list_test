<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Services\StaffService;

class StaffController extends BaseController
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    /**
     * Display a listing of staff members.
     */
    public function index()
    {
        return $this->sendResponse($this->staffService->getAll(), 'Staff retrieved successfully.');
    }

    /**
     * Display the specified staff member.
     */
    public function show(Staff $staff)
    {
        return $this->sendResponse($this->staffService->getById($staff), 'Staff retrieved successfully.');
    }

    /**
     * Store a newly created staff member.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'required|string|unique:staff,phone',
            'wallet' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
            'last_seen' => 'nullable|date',
            'manage' => 'nullable|boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        $staff = $this->staffService->create($data);

        return $this->sendResponse($staff, 'Staff created successfully.', 201);
    }

    /**
     * Update the specified staff member.
     */
    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:staff,email,' . $staff->id,
            'phone' => 'sometimes|string|unique:staff,phone,' . $staff->id,
            'wallet' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|boolean',
            'last_seen' => 'sometimes|date',
            'manage' => 'sometimes|boolean',
            'company_id' => 'sometimes|exists:companies,id',
        ]);

        $updatedStaff = $this->staffService->update($staff, $data);

        return $this->sendResponse($updatedStaff, 'Staff updated successfully.');
    }

    /**
     * Remove the specified staff member.
     */
    public function destroy(Staff $staff)
    {
        $this->staffService->delete($staff);

        return $this->sendResponse([], 'Staff member deleted successfully.');
    }
}
