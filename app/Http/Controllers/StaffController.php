<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        return response()->json(Staff::with('company')->get());
    }

    public function show(Staff $staff)
    {
        return response()->json($staff->load('company'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'required|string|unique:staff,phone',
            'wallet' => 'numeric|min:0',
            'status' => 'in:active,inactive',
            'last_seen' => 'nullable|date',
            'manage' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        $staff = Staff::create($data);

        return response()->json($staff, 201);
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:staff,email,' . $staff->id,
            'phone' => 'sometimes|string|unique:staff,phone,' . $staff->id,
            'wallet' => 'numeric|min:0',
            'status' => 'in:active,inactive',
            'last_seen' => 'nullable|date',
            'manage' => 'boolean',
            'company_id' => 'sometimes|exists:companies,id',
        ]);

        $staff->update($data);

        return response()->json($staff);
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        return response()->json(['message' => 'Staff deleted successfully.']);
    }
}
