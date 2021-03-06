<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\map;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->word(),
            'category_code' => $this->faker->word(),
            'slug' => $this->faker->word(),
            'status' => 1,
        ];
    }
}
