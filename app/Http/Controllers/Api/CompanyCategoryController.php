<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Services\CompanyCategoryService;

class CompanyCategoryController extends BaseController
{
    protected $companyCategoryService;

    public function __construct(CompanyCategoryService $companyCategoryService)
    {
        $this->companyCategoryService = $companyCategoryService;
    }

    /**
     * List all company categories.
     */
    public function index()
    {
        try {
            $categories = $this->companyCategoryService->getAll();
            return $this->sendResponse('Companies retrieved successfully', $categories);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Show a single company category.
     */
    public function show(CompanyCategory $companyCategory)
    {
        try {
            $categoryData = $this->companyCategoryService->getById($companyCategory);
            return $this->sendResponse('Category retrieved successfully', $categoryData);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Store a newly created company category.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|unique:company_categories,name',
            ]);

            $category = $this->companyCategoryService->create($data);

            return $this->sendResponse('Categories created successfully', $category, true, [], 201);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Update an existing company category.
     */
    public function update(Request $request, CompanyCategory $companyCategory)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|string|unique:company_categories,name,' . $companyCategory->id,
            ]);

            $updatedCategory = $this->companyCategoryService->update($companyCategory, $data);

            return $this->sendResponse('Category updated successfully', $updatedCategory);

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Delete a company category.
     */
    public function destroy(CompanyCategory $companyCategory)
    {
        try {
            $this->companyCategoryService->delete($companyCategory);
            return $this->sendResponse([], 'Company category deleted successfully');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
