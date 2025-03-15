<?php
namespace Database\Seeders;

use App\Models\Staff;
use App\Models\Company;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('No companies found! Seeding default companies...');
            Company::factory()->count(3)->create();
            $companies = Company::all();
        }

        foreach ($companies as $company) {
            Staff::factory()->count(5)->create([
                'company_id' => $company->id,
            ]);
        }
    }
}
