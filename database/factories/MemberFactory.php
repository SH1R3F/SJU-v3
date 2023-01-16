<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Member $member) {
            Subscription::factory()->for($member)->create();
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nationalities = array_keys(config('sju.nationalities'));
        return [
            'national_id' => rand(1111111111, 9999999999),
            'national_id_source' => fake()->word,
            'national_id_date' => fake()->date,
            'fname_ar' => fake()->firstName,
            'sname_ar' => fake()->firstName,
            'tname_ar' => fake()->firstName,
            'lname_ar' => fake()->firstName,
            'fname_en' => fake('en_GB')->firstName,
            'sname_en' => fake('en_GB')->firstName,
            'tname_en' => fake('en_GB')->firstName,
            'lname_en' => fake('en_GB')->firstName,
            'gender' => rand(0, 1),
            'birthday_h' => fake()->date,
            'birthday_m' => fake()->date,
            'nationality' => $nationalities[rand(0, count($nationalities) - 1)],
            'qualification' => fake()->word,
            'major' => fake()->word,
            'journalistic_profession' => fake()->jobTitle,
            'journalistic_employer' => fake()->company,
            'newspaper_type' => rand(1, 2),
            'non_journalistic_profession' => fake()->jobTitle,
            'non_journalistic_employer' => fake()->company,

            'workphone' => rand(11111, 999999),
            'workphone_ext' => rand(11, 99),
            'fax' => rand(11111, 999999),
            'fax_ext' => rand(11, 99),

            'postbox' => rand(11, 999999),
            'postcode' => rand(11, 999999),
            'postcity' => fake()->city,
            'branch_id' => rand(1, 17),
            'delivery_option' => $x = rand(1, 2),
            'delivery_address' => $x === 2 ? fake()->address : null,

            'email' => fake()->unique()->safeEmail,
            'mobile' => "96650" . rand(1111111, 9999999),
            'password' => bcrypt('password'),
            'profile_photo' => rand(0, 1) ? 'members/1231323121/CCIFvqUu8S1MUbeYYlwIiyW6rTLBRYfFiAyx2uxH.jpg' : null,
            'national_id_photo' => rand(0, 1) ? 'members/1231323121/CCIFvqUu8S1MUbeYYlwIiyW6rTLBRYfFiAyx2uxH.jpg' : null,
            'statement_photo' => rand(0, 1) ? 'members/1231323121/CCIFvqUu8S1MUbeYYlwIiyW6rTLBRYfFiAyx2uxH.jpg' : null,
            'license_photo' => rand(0, 1) ? 'members/1231323121/CCIFvqUu8S1MUbeYYlwIiyW6rTLBRYfFiAyx2uxH.jpg' : null,
            'contract_photo' => rand(0, 1) ? 'members/1231323121/CCIFvqUu8S1MUbeYYlwIiyW6rTLBRYfFiAyx2uxH.jpg' : null,
            'exp_flds_lngs' => rand(0, 1) ? [
                'fields' => [[
                    'title' => fake()->sentence
                ]],
                'languages' => [[
                    'title' => fake()->sentence,
                    'level' => fake()->word
                ]],
                'experiences' => [[
                    'title' => fake()->sentence,
                    'years' => rand(1, 6)
                ]],
            ] : null,
        ];
    }
}
