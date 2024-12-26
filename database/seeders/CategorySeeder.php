<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Home & Kitchen', 'slug' => 'home-kitchen'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Beauty & Health', 'slug' => 'beauty-health'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
            ['name' => 'Movies & Music', 'slug' => 'movies-music'],
            ['name' => 'Grocery', 'slug' => 'grocery'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
