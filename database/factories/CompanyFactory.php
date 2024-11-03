<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'adresse' => $this->faker->word(),
            'town' => $this->faker->word(),
            'country' => $this->faker->country(),
            'phone' => $this->faker->phoneNumber(),
            'mail' => $this->faker->word(),
            'siret' => $this->faker->word(),
        ];
    }
}
