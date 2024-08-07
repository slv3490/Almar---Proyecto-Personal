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
            "image_uri" => "4e69cd77960c6e49cbef9af566913560.webp",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "4f4773979b523c8c455af54f1a2f399d.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "88f018b428d4c2aeb52c9b493317b453.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "4e69cd77960c6e49cbef9af566913560.webp",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 77.99,
            "image_uri" => "4f4773979b523c8c455af54f1a2f399d.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 13.99,
            "image_uri" => "88f018b428d4c2aeb52c9b493317b453.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 1
        ]);

        //SPECTATOR
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "4e69cd77960c6e49cbef9af566913560.webp",
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
            "image_uri" => "88f018b428d4c2aeb52c9b493317b453.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
        Course::create([
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "price" => 199.99,
            "image_uri" => "4e69cd77960c6e49cbef9af566913560.webp",
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
            "image_uri" => "88f018b428d4c2aeb52c9b493317b453.jpg",
            "url" => md5(uniqid(rand(), true)),
            "user_id" => 3
        ]);
    }
}
