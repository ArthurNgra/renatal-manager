<?php

namespace Database\Factories;

use App\Models\PrestationModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestationFactory extends Factory
{
    protected $model = PrestationModel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'prix' => $this->faker->randomFloat(),
        ];
    }
}
