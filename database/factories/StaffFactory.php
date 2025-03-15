<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StaffFactory extends Factory
{
    protected $model = Staff::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'wallet' => $this->faker->randomFloat(2, 0, 1000),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'last_seen' => now()->subMinutes(rand(1, 1440)),
            'manage' => $this->faker->boolean(),
            'company_id' => Company::inRandomOrder()->first()?->id ?? Company::factory()->create()->id,
        ];
    }
}
