<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $member = Member::inRandomOrder()->first();
        return [
            'invoice_number' => rand(1000000, 9000000),
            'member_id' => $member->id,
            'subscription_id' => $member->subscription->id,
            'amount' => fake()->randomDigit
        ];
    }
}
