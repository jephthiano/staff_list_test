<?php
namespace Database\Factories;

use App\Models\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyCategoryFactory extends Factory
{
    protected $model = CompanyCategory::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(), // Generate UUID manually
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
