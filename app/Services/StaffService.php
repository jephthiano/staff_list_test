<?php
namespace App\Services;

use App\Models\Staff;
use Illuminate\Support\Str;

class StaffService
{
    /**
     * Get all staff members.
     */
    public function getAll()
    {
        return Staff::with('company')->get();
    }

    /**
     * Get a single staff member.
     */
    public function getById(Staff $staff)
    {
        return $staff->load('company');
    }

    /**
     * Create a new staff member.
     */
    public function create(array $data)
    {
        $data['id'] = Str::uuid(); // Generate UUID for ID
        return Staff::create($data);
    }

    /**
     * Update a staff member.
     */
    public function update(Staff $staff, array $data)
    {
        $staff->update($data);
        return $staff;
    }

    /**
     * Delete a staff member.
     */
    public function delete(Staff $staff)
    {
        return $staff->delete();
    }
}
