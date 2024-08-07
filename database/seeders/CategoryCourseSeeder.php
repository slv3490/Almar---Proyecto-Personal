<?php

namespace Database\Seeders;

use App\Models\CategoryCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numbersOfCourses = 12;
        for($i = 1; $numbersOfCourses >= $i; $i++) {
            $numbers = range(1, rand(1,8));
            shuffle($numbers);
            foreach ($numbers as $number) {
                CategoryCourse::create([
                    "category_id" => $number,
                    "course_id" => $i
                ]);
            }
        }
    }
}
