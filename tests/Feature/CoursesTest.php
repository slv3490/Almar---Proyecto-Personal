<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoursesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_courses_page(): void
    {
        $response = $this->get(route("cursos"));

        $response->assertViewIs("cursos");
        $response->assertStatus(200);
    }

    public function test_can_filter_a_course_with_a_search(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);
        $filePath = $file->store("images", "public");
        $user = User::factory()->create();
        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Curso sobre Model View Controller",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => basename($filePath),
            "url" => md5(uniqid(rand(), true)),
            "price" => 90,
            "user_id" => $user->id,
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->get("/cursos?search=curso");

        $response->assertViewIs("cursos");
        $response->assertDontSeeText("No hay cursos con ese nombre.");
        $response->assertViewHasAll([
            "courses",
            "categories"
        ]);
        $response->assertStatus(200);

        $course->delete();
        $user->delete();
    }
    public function test_can_filter_a_course_that_does_not_exist_with_the_search(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);
        $filePath = $file->store("images", "public");
        $user = User::factory()->create();
        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Curso sobre Model View Controller",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => basename($filePath),
            "url" => md5(uniqid(rand(), true)),
            "price" => 90,
            "user_id" => $user->id,
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->get("/cursos?search=course+that+does+not+exist");

        $response->assertViewIs("cursos");
        $response->assertSeeText("No hay cursos con ese nombre.");
        $response->assertStatus(200);
        $course->delete();
        $user->delete();
    }
}