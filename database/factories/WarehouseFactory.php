<?php

namespace Database\Factories;

use App\Models\WareHouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WareHouse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'detail' => $this->faker->sentence(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
