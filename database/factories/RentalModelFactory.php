<?php

namespace Database\Factories;

use App\Models\ClientModel;
use App\Models\RentalModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RentalModelFactory extends Factory
{
    protected $model = RentalModel::class;

    public function definition(): array
    {
        return [
            'referal_phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'from' => Carbon::now(),
            'to' => Carbon::now(),
            'special_demands' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'client_id' => ClientModel::factory(),
        ];
    }
}
