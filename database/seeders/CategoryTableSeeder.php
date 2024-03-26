<?php

namespace Database\Seeders;

use App\Models\Backend\Category;
use App\Models\Backend\ChildCategory;
use App\Models\Backend\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Action', 'slug' => 'action', 'icon' => 'fas fa-fist-raised',
                'subCategories' => [
                    [
                        'name' => 'Shooter', 'slug' => 'shooter', 'category_id' => 1,
                        'childCategories' => [
                            ['name' => 'First Person Shooter', 'slug' => 'fps', 'category_id' => 1, 'sub_category_id' => 1],
                            ['name' => 'Third Person Shooter', 'slug' => 'tps', 'category_id' => 1, 'sub_category_id' => 1],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Adventure', 'slug' => 'adventure', 'icon' => 'fas fa-map',
                'subCategories' => [
                    [
                        'name' => 'shooter nb3', 'slug' => 'shooter-nb3', 'category_id' => 2,
                        'childCategories' => [
                            ['name' => '2D Fighter', 'slug' => '2d-fighter', 'category_id' => 2, 'sub_category_id' => 2],
                            ['name' => '3D Fighter', 'slug' => '3d-fighter', 'category_id' => 2, 'sub_category_id' => 2],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'RPG', 'slug' => 'rpg', 'icon' => 'fas fa-dice-d20',
                'subCategories' => [

                    [
                        'name' => 'Fighting', 'slug' => 'fighting', 'category_id' => 3,
                        'childCategories' => [
                            ['name' => 'Open World', 'slug' => 'open-world', 'category_id' => 3, 'sub_category_id' => 3],
                            ['name' => 'Sandbox', 'slug' => 'sandbox', 'category_id' => 3, 'sub_category_id' => 3]
                        ]
                    ],
                ]
            ],
            ['name' => 'Strategy', 'slug' => 'strategy', 'icon' => 'fas fa-chess-board'],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => 'fas fa-futbol'],
        ];



        foreach ($categories as $category) {

            Category::create(Arr::except($category, 'subCategories'));

            if (isset($category['subCategories'])) {

                foreach ($category['subCategories'] as $subCategory) {

                    SubCategory::create(Arr::except($subCategory, "childCategories"));

                    if (isset($subCategory['childCategories'])) {

                        foreach ($subCategory['childCategories'] as $childCategory) {

                            ChildCategory::create($childCategory);
                        }
                    }
                }
            }
        }
    }
}
