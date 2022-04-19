<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElements(['M', 'F'])[0];

        $genderToShow = ($gender === 'M')? 'F':'M';

        return [
            'first_name' => $this->faker->firstName(),
            'last_name'=> $this->faker->lastName(),
            'age'=> $this->faker->numberBetween(18, 80),
            'gender'=> $gender,
            'location' =>$this->faker->country(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender_to_show'=> $genderToShow,
            'age_from' => 18,
            'age_till' =>100,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image' =>$this->faker->image('public/storage', 640, 480 ,null, false),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}

