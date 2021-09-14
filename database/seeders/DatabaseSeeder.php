<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\Details;
use App\Models\ExpenseCategory;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\TaxType;
use App\Models\Unit;
use App\Models\WareHouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
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

        Category::insert([
            'category_name' => 'Mobile Devices',
            'category_code' => '0002',
            'slug' => 'mobile-devices',
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

        WareHouse::insert([
            'name' => 'Electronic Warehouse',
            'detail' => 'This warehouse stores all the electronic devices.',
            'phone' => 'Phone number is not provided.',
        ]);

        Product::insert([
            [
                'name' => 'Smart Television',
                'code' => '00001',
                'description' => 'This is a description',
                'price' => 1200,
                'category_id' => 1,
                'brand_id' => 1,
                'unit_id' => 1,
                'tax_type_id' => 1,
            ],
        ]);

        Product::insert([
            'name' => 'Android Smartphone',
            'code' => '000200',
            'description' => 'This is a description',
            'price' => 150,
            'unit_id' => 2,
            'category_id' => 2,
            'brand_id' => 1,
            'tax_type_id' => 1,
        ]);

        ProductAttributes::insert([
            'size' => 'Large',
            'color' => 'Black',
            'additional_price' => '1200',
            'sku' => 'SMA-LAR-BLA',
            'quantity' => 12,
            'product_id' => 1,
        ]);

        CustomerGroup::insert([
            'name' => 'general',
            'percentage' => '10',
        ]);
        Customer::insert([
            'group_id' => 1,
            'firstname' => 'raju',
            'lastname' => 'master',
            'phone_number' => '9800215468',
            'email' => 'sovit@gmail.com',
            'address' => 'Thapathali',
        ]);
        ExpenseCategory::insert([
            'code' => '0001',
            'name' => 'Kitchen'
        ]);
        Account::insert([
            'account_no' => '1234567890',
            'name' => 'Saral Raut',
            'initial_balance' => '50000',
            'note' => 'Saral"s account for kitchen uses',
        ]);
    }
}
