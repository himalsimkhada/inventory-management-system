<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'short_name' => $this->faker->word(),
            'base_unit' => $this->faker->word(),
            'operator' => $this->faker->word(),
            'operation_value' => $this->faker->word(),
        ];
    }
}
