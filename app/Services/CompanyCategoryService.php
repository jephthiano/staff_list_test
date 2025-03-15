<?php

namespace App\Services;

use App\Models\CompanyCategory;
use Illuminate\Support\Str;

class CompanyCategoryService
{
    /**
     * Get all company categories.
     */
    public function getAll()
    {
        return CompanyCategory::with('company')->get();
    }

    /**
     * Get a single company category.
     */
    public function getById(CompanyCategory $companyCategory)
    {
        return $companyCategory->load('company');
    }

    /**
     * Create a new company category.
     */
    public function create(array $data)
    {
        $data['id'] = Str::uuid(); // Generate UUID for the ID
        return CompanyCategory::create($data);
    }

    /**
     * Update a company category.
     */
    public function update(CompanyCategory $companyCategory, array $data)
    {
        $companyCategory->update($data);
        return $companyCategory;
    }

    /**
     * Delete a company category.
     */
    public function delete(CompanyCategory $companyCategory)
    {
        return $companyCategory->delete();
    }
}
