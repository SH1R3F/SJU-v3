<?php

namespace Database\Factories;

use App\Models\TechnicalSupportTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TechnicalSupportMessage>
 */
class TechnicalSupportMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ticket_id' => TechnicalSupportTicket::inRandomOrder()->first()->id,
            'body' => fake()->paragraph(rand(1, 6)),
            'sender' => rand(0, 1)
        ];
    }
}
