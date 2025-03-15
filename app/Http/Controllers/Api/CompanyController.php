<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index()
    {
        return response()->json(Company::with('category', 'staff')->get());
    }

    /**
     * Store a newly created company in the database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'nullable|email|unique:companies,email',
            'phone' => 'nullable|string|unique:companies,phone',
            'address' => 'nullable|string',
            'company_category_id' => 'required|exists:company_categories,id',
        ]);

        $data['id'] = Str::uuid(); // Generate a UUID for the ID

        $company = Company::create($data);

        return response()->json($company, 201);
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        return response()->json($company->load('category', 'staff'));
    }

    /**
     * Update the specified company in the database.
     */
    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:companies,email,' . $company->id,
            'phone' => 'sometimes|string|unique:companies,phone,' . $company->id,
            'address' => 'sometimes|string',
            'company_category_id' => 'sometimes|exists:company_categories,id',
        ]);

        $company->update($data);

        return response()->json($company);
    }

    /**
     * Remove the specified company from the database.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully.']);
    }
}
