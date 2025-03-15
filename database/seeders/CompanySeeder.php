<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = CompanyCategory::all();

        // Ensure at least one category exists before proceeding
        if ($categories->isEmpty()) {
            $this->command->info('No categories found! Seeding default categories...');
            CompanyCategory::factory()->count(3)->create(); // Seed 3 categories
            $categories = CompanyCategory::all(); // Re-fetch categories
        }

        foreach ($categories as $category) {
            Company::factory()->create([
                'company_category_id' => $category->id,
            ]);
        }
    }
}