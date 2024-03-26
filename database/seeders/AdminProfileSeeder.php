<?php

namespace Database\Seeders;

use App\Models\Backend\Vendor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAdmin = new User;
        $userAdmin->fill([
            'name' => 'Admin User',
            'username' => 'admin user',
            'email' => 'admin@app.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => bcrypt('123456')
        ])->save();

        $faker = Faker::create();

        $vendorShopProfile = [
            'user_id' => $userAdmin->id,
            'shop_name'=>'mol lbrwita',
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
