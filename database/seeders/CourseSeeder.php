<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.325a1d4206021ef6f92dbeafe07c17b2.jpg
     */
    public function run(): void
    {
        //ADMIN
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "02a556571a2f7ad9a04fb55ed8ab561b.webp",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "2f5074bae16ad5aba484baa6d1bb01bf.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "aa3aeb6cb7c3c7260323656eb54aab03.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "cdb8b3ce9cb1a0a5246e8f0f0ea7c192.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "c386b447e15913ef217675da0bb7c13f.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "cdb8b3ce9cb1a0a5246e8f0f0ea7c192.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);

        //SPECTATOR
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "e38e62217ef186df4eae2e8dfab22b47.webp",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "e38e62217ef186df4eae2e8dfab22b47.webp",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "cdb8b3ce9cb1a0a5246e8f0f0ea7c192.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "aa3aeb6cb7c3c7260323656eb54aab03.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "4f4773979b523c8c455af54f1a2f399d.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "aa3aeb6cb7c3c7260323656eb54aab03.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
    }
}
