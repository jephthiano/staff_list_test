<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // Generate UUID manually
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'company_category_id' => CompanyCategory::factory(),
        ];
    }
}
