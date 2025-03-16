<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use Exception;
use Illuminate\Support\Str;

class CompanyController extends BaseController
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the companies.
     */
    public function index()
    {
        try {
            $companies = $this->companyService->getAll();
            return $this->sendResponse('Companies retrieved successfully', $companies);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        try {
            $companyData = $this->companyService->getById($company);
            return $this->sendResponse('Company retrieved successfully', $companyData);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Store a newly created company in the database.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'nullable|email|unique:companies,email',
                'phone' => 'nullable|string|unique:companies,phone',
                'address' => 'nullable|string',
                'company_category_id' => 'required|exists:company_categories,id',
            ]);

            $data['id'] = Str::uuid();
            $company = $this->companyService->create($data);

            return $this->sendResponse('Company created successfully', $company, true, [], 201);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update the specified company in the database.
     */
    public function update(Request $request, Company $company)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|string',
                'email' => 'sometimes|nullable|email|unique:companies,email,' . $company->id,
                'phone' => 'sometimes|nullable|string|unique:companies,phone,' . $company->id,
                'address' => 'sometimes|string|nullable',
                'company_category_id' => 'sometimes|exists:company_categories,id',
            ]);

            $updatedCompany = $this->companyService->update($company, $data);

            return $this->sendResponse('Company updated successfully', $updatedCompany);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
    
    /**
     * Remove the specified company from the database.
     */
    public function destroy(Company $company)
    {
        try {
            $this->companyService->delete($company);
            return $this->sendResponse([], 'Company deleted successfully');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
