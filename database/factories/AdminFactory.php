<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fname_ar' => $fname = fake()->firstName,
            'lname_ar' => $lname = fake()->lastName,
            'username' => Str::slug("$fname $lname"),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => fake()->phoneNumber,
            'password' => bcrypt('password')
        ];
    }
}
