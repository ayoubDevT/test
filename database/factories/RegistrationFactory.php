<?php

namespace Database\Factories;

use App\Models\registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = registration::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'created_at'=> $this->faker->dateTimeInInterval($startDate = '-7 days', $interval = '+ 5 days', $timezone = null) ,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'cni' => $this->faker->randomNumber(),
            'cne' => $this->faker->randomNumber(),
            'referral' => $this->faker->randomElement(['instagram', 'facebook', 'youtube', 'linkdin']),
        ];
    }
}
