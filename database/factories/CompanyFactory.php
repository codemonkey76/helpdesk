<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $states = ['QLD', 'NSW', 'ACT', 'VIC', 'TAS', 'NT', 'SA', 'WA'];

        return [
            'name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->streetAddress,
            'suburb' => $this->faker->city,
            'state' => $states[mt_rand(0, sizeof($states)-1)],
            'postcode' => $this->faker->postcode
        ];
    }
}
