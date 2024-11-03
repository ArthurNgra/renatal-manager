<?php

namespace Database\Factories;

use App\Models\ClientModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClientModelFactory extends Factory
{
    protected $model = ClientModel::class;

    public function definition(): array
    {
        return [
            'Society' => $this->faker->word(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'mail' => $this->faker->email(),
            'address' => $this->faker->address(),
            'siret' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
