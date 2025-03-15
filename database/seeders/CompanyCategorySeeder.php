<?php

namespace Database\Seeders;

use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categoryName = ['pharmacy', 'manufacturer', 'hospital', 'clinic', 'insurance', 'other'];
        foreach ($categoryName as $name) {
            CompanyCategory::factory()->create([
                'name' => $name,
            ]);
        }
    }
}