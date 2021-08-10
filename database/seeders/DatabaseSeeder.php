<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Details;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\TaxType;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => "Super Admin",
            'email' => "admin@admin.com",
            'password' => bcrypt('password'),
            'phone' => '0123456789',
            'address' => 'Shantinagar, Kathmandu, Nepal',
            'status' => 1,
            'image' => 'default.png',
        ]);


        Details::insert([
            'name' => 'IMS',
            'fav_icon' => 'favicon.ico.png',
            'logo' => 'logo.png',
        ]);

        TaxType::insert([
            ['type' => 'exclusive'],
            ['type' => 'inclusive'],
        ]);

        Brand::insert([
            'brand_name' => 'SAMSUNG',
            'brand_code' => '0001',
            'status' => 1,
        ]);

        Category::insert([
            'category_name' => 'Electronics',
            'category_code' => '0001',
            'slug' => 'electronics',
            'status' => 1,
        ]);

        Unit::insert([
            [
                'name' => 'Dozen',
                'short_name' => 'dz',
                'base_unit' => 0,
            ],
        ]);

        Unit::insert([
            [
                'name' => 'Pieces',
                'short_name' => 'pcs',
                'base_unit' => 1,
                'operator' => '/',
                'operation_value' => '12',
            ]
        ]);

        Product::insert([
            [
                'product_name' => 'Smart Television',
                'product_code' => '00001',
                'barcode_symbology' => '####',
                'product_description' => 'This is a description',
                'category_id' => 1,
                'brand_id' => 1,
                'unit_id' => 1,
                'tax_type_id' => 1,
            ],
        ]);

        Product::insert([
            'product_name' => 'Android Smartphone',
            'product_code' => '000200',
            'barcode_symbology' => '####',
            'product_description' => 'This is a description',
            'unit_id' => 2,
            'tax_type_id' => 1,
        ]);

        ProductAttributes::insert([
            'size' => 'Large',
            'color' => 'Black',
            'price' => '1200',
            'sku' => 'default',
            'product_id' => 1,
         ]);

        Image::insert([
            'image' => 'image.jpg',
            'product_id' => 1,
        ]);

        Image::insert([
            'image' => 'image.jpg',
            'product_id' => 2,
        ]);
    }
}
