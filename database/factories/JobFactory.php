<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
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
            "title" => $faker->jobTitle,
            "description" => $faker->paragraphs(3, true),
            "salary" => $faker->numberBetween(5_000, 1_50_000),
            "location" => $faker->city,
            "category" => $faker->randomElement(Job::$category),
            "experience" => $faker->randomElement(Job::$experience),
        ];
    }
}
