<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        config(['app.locale' => 'en_IN']);
    
        $faker = \Faker\Factory::create('en_IN');
    
        return [
            "company_name"=> $faker->company

        ];
    }
}
