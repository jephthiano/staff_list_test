<?php

namespace App\Http\Controllers;

use App\Models\CompanyCategory;
use Illuminate\Http\Request;
use App\Services\CompanyCategoryService;

class CompanyCategoryController extends Controller
{
    protected $companyCategoryService;

    public function __construct(CompanyCategoryService $companyCategoryService)
    {
        $this->companyCategoryService = $companyCategoryService;
    }

    /**
     * Display a listing of company categories.
     */
    public function index()
    {
        return response()->json($this->companyCategoryService->getAll());
    }

    /**
     * Store a newly created company category.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:company_categories,name',
        ]);

        $category = $this->companyCategoryService->create($data);

        return response()->json($category, 201);
    }

    /**
     * Display the specified company category.
     */
    public function show(CompanyCategory $companyCategory)
    {
        return response()->json($this->companyCategoryService->getById($companyCategory));
    }

    /**
     * Update the specified company category.
     */
    public function update(Request $request, CompanyCategory $companyCategory)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|unique:company_categories,name,' . $companyCategory->id,
        ]);

        $updatedCategory = $this->companyCategoryService->update($companyCategory, $data);

        return response()->json($updatedCategory);
    }

    /**
     * Remove the specified company category.
     */
    public function destroy(CompanyCategory $companyCategory)
    {
        $this->companyCategoryService->delete($companyCategory);

        return response()->json(['message' => 'Company category deleted successfully.']);
    }
}
