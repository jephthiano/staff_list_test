<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanyService
{
    /**
     * Get all companies.
     */
    public function getAll()
    {
        return Company::with('category')->get();
    }

    /**
     * Get a single company.
     */
    public function getById(Company $company)
    {
        return $company->load('category');
    }

    /**
     * Create a new company.
     */
    public function create(array $data)
    {
        $data['id'] = Str::uuid(); // Generate UUID for ID
        return Company::create($data);
    }

    /**
     * Update a company.
     */
    public function update(Company $company, array $data)
    {
        $company->update($data);
        return $company;
    }

    /**
     * Delete a company.
     */
    public function delete(Company $company)
    {
        return $company->delete();
    }
}
