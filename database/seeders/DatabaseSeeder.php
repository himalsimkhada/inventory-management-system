<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Details;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Admin::insert([
            'name' => "Super Admin",
            'email' => "admin@admin.com",
            'password' => bcrypt('password'),
        ]);
        Admin::insert([
            'name' => "Super Admin",
            'email' => "tomh8963@gmail.com",
            'password' => bcrypt('password'),
        ]);

        Details::insert([
            'name' => 'Test',
        ]);
//        Category::factory()->count(20)->create();

        for($i = 0; $i < 17; $i++){
            $name = $faker->word . ' ' . $faker->word;
            Category::insert([
                'category_name' => $name,
                'category_code' => $faker->randomNumber($nbDigits = 3, $strict = false),
                'slug' => Str::slug($name, '-'),
                'status' => 1,
            ]);
        }
    }
}
