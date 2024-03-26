<?php

namespace Database\Seeders;

use App\Models\Backend\Vendor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VendrorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userVendor = new User;
        $userVendor->fill( [
            'name' => 'Vendor User',
            'username' => 'vendor user',
            'email' => 'vendor@app.com',
            'role' => 'vendor',
            'status' => 'active',
            'password' => bcrypt('123456')
        ])->save();

        $faker = Faker::create();

        $vendorShopProfile = [
            'user_id' => $userVendor->id,
            'shop_name'=>'mol lhonda',
            'banner' => 'uploads/vendors/default.png',
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'adress' => $faker->address(),
            'description' => $faker->paragraph,
        ];

        Vendor::create($vendorShopProfile);
    }
}
