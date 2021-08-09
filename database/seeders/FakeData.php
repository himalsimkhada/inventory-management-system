<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;
use App\Models\WareHouse;
use Illuminate\Database\Seeder;

class FakeData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(20)->create();
        Brand::factory()->count(20)->create();
        Unit::factory()->count(20)->create();
        WareHouse::factory()->count(20)->create();
    }
}
