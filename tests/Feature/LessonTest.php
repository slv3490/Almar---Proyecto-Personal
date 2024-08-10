<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_all_lessons_in_a_course(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();
        $user->givePermissionTo("read lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->get(route("lesson.lesson", $course->url));
        $response->assertViewIs("user.dashboard.lessons.show-lesson");
        $response->assertStatus(200);
        $user->delete();
    }

    public function test_can_not_see_all_lessons_in_a_course_if_you_do_not_have_the_necessary_permissions(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->get(route("lesson.lesson", $course->url));
        $response->assertStatus(401);
        $user->delete();
    }

    public function test_can_create_lesson(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();
        $user->givePermissionTo("create lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about pre programming",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->post(route("store-lessons", $course->id), [
            "title" => "Lesson Number One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route("lesson.lesson", $course->url));
        $this->assertDatabaseHas("lessons", [
            "title" => "Lesson Number One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);
        $user->delete();
    }

    public function test_can_not_see_create_lessons_page_if_you_do_not_have_the_necessary_permissions(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->get(route("create-lessons", $course->url));
        $response->assertStatus(401);
        $user->delete();
    }

    public function test_can_not_create_lessons_if_you_do_not_have_the_necessary_permissions(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->get(route("store-lessons", $course->url), [
            "title" => "Lesson Number One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);
        $response->assertStatus(401);
        $this->assertDatabaseMissing("lessons", [
            "title" => "Lesson Number One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);
        $user->delete();
    }

    public function test_can_see_update_lesson_page(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();
        $user->givePermissionTo("read lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $lesson = Lesson::create([
            "title" => "Lesson One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);

        $response = $this->actingAs($user)->get(route("show-lessons", ["courseUrl" => $course->url, "id" => $lesson->id]));
        $response->assertStatus(200);
        $user->delete();
    }

    public function test_can_update_lessons(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();
        $user->givePermissionTo("update lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $lesson = Lesson::create([
            "title" => "Lesson One",
            "description" => "Learning about testing",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);

        $response = $this->actingAs($user)->put(route("update-lessons", ["courseUrl" => $course->url, "id" => $lesson->id]), [
            "title" => "¿What is Javascript?",
            "description" => "Learn about the basics of Javascript.",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
        ]);
        $response->assertStatus(302);
        $response->assertRedirectToRoute("lesson.lesson", $course->url);
        $this->assertDatabaseHas("lessons", [
            "id" => $lesson->id,
            "title" => "¿What is Javascript?",
            "description" => "Learn about the basics of Javascript.",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt"
        ]);
        $user->delete();
    }

    public function test_can_not_update_lessons_if_you_do_not_have_the_necessary_permissions(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $lesson = Lesson::create([
            "title" => "Ingredients of the science",
            "description" => "lesson on the importance of ingredients",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);

        $response = $this->actingAs($user)->put(route("update-lessons", ["courseUrl" => $course->url, "id" => $lesson->id]), [
            "title" => "¿How to cook a egg?",
            "description" => "learn how to cook.",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
        ]);
        $response->assertStatus(401);
        $this->assertDatabaseMissing("lessons", [
            "title" => "¿How to cook a egg?",
            "description" => "learn how to cook.",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt"
        ]);
        $user->delete();
    }

    public function test_can_remove_lesson(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();
        $user->givePermissionTo("delete lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $lesson = Lesson::create([
            "title" => "title",
            "description" => "description",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);

        $response = $this->actingAs($user)->delete(route("delete-lessons", ["courseUrl" => $course->url, "id" => $lesson->id]));
        $response->assertStatus(302);
        $response->assertRedirect(route("lesson.lesson", $course->url));
        $this->assertDatabaseMissing("lessons", [
            "id" => $lesson->id,
            "title" => "title",
            "description" => "description",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt"
        ]);
        $user->delete();
    }

    public function test_can_not_remove_lessons_if_you_do_not_have_the_necessary_permissions(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);

        $user = User::factory()->create();

        $idCategory = [
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "7"
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $lesson = Lesson::create([
            "title" => "Ingredients of the science",
            "description" => "lesson on the importance of ingredients",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt",
            "course_id" => $course->id
        ]);

        $response = $this->actingAs($user)->delete(route("delete-lessons", ["courseUrl" => $course->url, "id" => $lesson->id]));
        $response->assertStatus(401);
        $this->assertDatabaseHas("lessons", [
            "title" => "Ingredients of the science",
            "description" => "lesson on the importance of ingredients",
            "content_uri" => "https://youtube.com/embed/aZ9jJcPCa7Q?si=rD9L0P8LK5c_6XZt"
        ]);
        $user->delete();
    }
}
