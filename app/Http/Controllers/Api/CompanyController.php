<?php

namespace App\Http\Controllers\Api;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Services\StaffService;
use App\Exceptions\CustomApiException;
use Exception;
use Illuminate\Support\Str;

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
        try {
            $staff = $this->staffService->getAll();
            return response()->json([
                'status' => true,
                'message' => 'Staff members retrieved successfully',
                'response_data' => $staff,
                'error_data' => [],
            ], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified staff member.
     */
    public function show(Staff $staff)
    {
        try {
            $staffData = $this->staffService->getById($staff);
            return response()->json([
                'status' => true,
                'message' => 'Staff member retrieved successfully',
                'response_data' => $staffData,
                'error_data' => [],
            ], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Store a newly created staff member.
     */
    public function store(Request $request)
    {
        try {
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

            $data['id'] = Str::uuid(); // Generate a UUID for the ID

            $staff = $this->staffService->create($data);

            return response()->json([
                'status' => true,
                'message' => 'Staff member created successfully',
                'response_data' => $staff,
                'error_data' => [],
            ], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified staff member.
     */
    public function update(Request $request, Staff $staff)
    {
        try {
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

            return response()->json([
                'status' => true,
                'message' => 'Staff member updated successfully',
                'response_data' => $updatedStaff,
                'error_data' => [],
            ], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Remove the specified staff member.
     */
    public function destroy(Staff $staff)
    {
        try {
            $this->staffService->delete($staff);
            return response()->json([
                'status' => true,
                'message' => 'Staff member deleted successfully',
                'response_data' => [],
                'error_data' => [],
            ], 200);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Manually trigger an error.
     */
    public function triggerError($message, $details = [])
    {
        throw new CustomApiException($message, 403, $details);
    }
}
