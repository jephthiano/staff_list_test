<?php

namespace App\Http\Controllers\Api;

use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Services\CompanyCategoryService;
use App\Exceptions\CustomApiException;
use Exception;

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

            return response()->json([
                'status' => true,
                'message' => 'Categories retrieved successfully',
                'response_data' => $categories,
                'error_data' => [],
            ], 200);

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
            $category = $this->companyCategoryService->getById($companyCategory);

            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully',
                'response_data' => $category,
                'error_data' => [],
            ], 200);

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

            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'response_data' => $category,
                'error_data' => [],
            ], 201);

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

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'response_data' => $updatedCategory,
                'error_data' => [],
            ], 200);

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

            return response()->json([
                'status' => true,
                'message' => 'Company category deleted successfully',
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
