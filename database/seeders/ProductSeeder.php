<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Samsung Galaxy S21',
                'slug' => 'samsung-galaxy-s21',
                'description' => 'Latest Samsung Galaxy S21 smartphone with amazing features.',
                'price' => 799.99,
                'stock' => 50,
                'category_id' => 1, // Assuming category_id 1 corresponds to 'Electronics'
                'status' => 'active',
            ],
            [
                'name' => 'MacBook Pro 16"',
                'slug' => 'macbook-pro-16',
                'description' => 'High-performance laptop with Apple M1 chip.',
                'price' => 2399.99,
                'stock' => 30,
                'category_id' => 1, // Electronics
                'status' => 'active',
            ],
            [
                'name' => 'Nike Air Max 270',
                'slug' => 'nike-air-max-270',
                'description' => 'Comfortable and stylish Nike running shoes.',
                'price' => 129.99,
                'stock' => 75,
                'category_id' => 2, // Fashion
                'status' => 'active',
            ],
            [
                'name' => 'Leather Sofa',
                'slug' => 'leather-sofa',
                'description' => 'Premium quality leather sofa for modern living rooms.',
                'price' => 799.99,
                'stock' => 20,
                'category_id' => 4, // Home & Kitchen
                'status' => 'inactive',
            ],
            [
                'name' => 'Dell XPS 13',
                'slug' => 'dell-xps-13',
                'description' => 'Compact and powerful laptop from Dell with a stunning display.',
                'price' => 1199.99,
                'stock' => 40,
                'category_id' => 1, // Electronics
                'status' => 'active',
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'slug' => 'sony-wh-1000xm4',
                'description' => 'Wireless noise-canceling headphones with excellent sound quality.',
                'price' => 348.99,
                'stock' => 60,
                'category_id' => 1, // Electronics
                'status' => 'active',
            ],
            [
                'name' => 'TCL 55-inch 4K Smart TV',
                'slug' => 'tcl-55-inch-4k-smart-tv',
                'description' => '4K UHD Smart TV with built-in Alexa and Google Assistant.',
                'price' => 499.99,
                'stock' => 25,
                'category_id' => 1, // Electronics
                'status' => 'active',
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'slug' => 'adidas-ultraboost-22',
                'description' => 'Stylish and comfortable Adidas running shoes.',
                'price' => 180.00,
                'stock' => 50,
                'category_id' => 2, // Fashion
                'status' => 'active',
            ],
            [
                'name' => 'Instant Pot Duo 7-in-1',
                'slug' => 'instant-pot-duo-7-in-1',
                'description' => 'Multi-use pressure cooker, slow cooker, and rice cooker in one.',
                'price' => 89.99,
                'stock' => 100,
                'category_id' => 4, // Home & Kitchen
                'status' => 'active',
            ],
            [
                'name' => 'KitchenAid Stand Mixer',
                'slug' => 'kitchenaid-stand-mixer',
                'description' => 'Iconic stand mixer for baking, with various attachments available.',
                'price' => 349.99,
                'stock' => 15,
                'category_id' => 4, // Home & Kitchen
                'status' => 'active',
            ],
        ];

        // Insert products in batches to avoid memory exhaustion
        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

    }
}
