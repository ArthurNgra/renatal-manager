<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryModel;
use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MaterialModelFactory extends Factory
{
    protected $model = MaterialModel::class;

    public function definition(): array
    {
        return [
            'brand' => $this->faker->word(),
            'category_id' => Category::factory(),
            'model' => $this->faker->word(),
            'specs' => $this->faker->word(),
            'serial' => $this->faker->word(),
            'has_issue' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
