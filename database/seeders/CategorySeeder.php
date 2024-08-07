<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Lawyers"
        ]);
        Category::create([
            "name" => "Developers"
        ]);
        Category::create([
            "name" => "Teacher"
        ]);
        Category::create([
            "name" => "Environment"
        ]);
        Category::create([
            "name" => "Economy"
        ]);
        Category::create([
            "name" => "Tecnologys"
        ]);
        Category::create([
            "name" => "Rights"
        ]);
        Category::create([
            "name" => "Science"
        ]);
    }
}
