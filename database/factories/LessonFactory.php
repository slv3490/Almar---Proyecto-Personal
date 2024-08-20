<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "description" => fake()->paragraph(),
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=8dz_lwo55FKp2Yxv&t=1",
            "course_id" => rand(1, 12)
        ];
    }
}
