<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tests\DeleteUser;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoursesTest extends TestCase
{
    use DeleteUser;
    /**
     * A basic feature test example.
     */
    public function test_can_non_enter_to_the_courses_index_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("course.index"));
        $response->assertStatus(401);
        $this->deleteUser($user->email);
    }

    public function test_can_see_course_page(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("read lessons");
        
        $response = $this->actingAs($user)->get(route("course.index"));
        $response->assertViewIs("user.dashboard.courses.index");
        $response->assertViewHas([
            "title" => "Courses",
            "courses" => Course::where("user_id", $user->id)->paginate(10)
        ]);
        $response->assertStatus(200);
    }

    public function test_can_non_enter_to_the_create_courses_page_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("create-courses"));
        $response->assertStatus(401);
        $this->deleteUser($user->email);
    }

    public function test_can_create_a_new_course(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('testImage.webp')->size(15);
        $filePath = $file->store('images', "public");
        $user = User::factory()->create();
        $user->givePermissionTo("create lessons");

        $response = $this->actingAs($user)->post(route("store-courses"), [
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil consequuntur pariatur debitis, ad molestiae libero reiciendis earum odit voluptate eos excepturi veritatis enim dolor officiis optio at fugit esse?",
            "image_uri" => $file,
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => Auth::user()->id,
            "category_id" => "3, 5, 6"
        ]);
        
        Storage::disk('public')->assertExists("images/" . basename($filePath));
        $response->assertStatus(302);
        $response->assertRedirect(route("course.index"));
    }

    public function test_can_see_update_course_page() : void
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
            "image_uri" => $file->hashName(),
            "url" => md5(uniqid(rand(), true)),
            "price" => 20,
            "user_id" => $user->id
        ]);
        $course->categories()->attach($idCategory);

        $response = $this->actingAs($user)->get(route("show-courses", $course->id));
        $response->assertViewIs("user.dashboard.courses.update-courses");
        $response->assertViewHas([
            "course" => Course::find($course->id),
            "title" => "Course"
        ]);
        $response->assertStatus(200);
    }

    public function test_can_update_a_course() : void
    {
        Storage::fake('public');
        //imagen previa
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);
        //almacena el archivo
        $filePath = $file->store("images", "public");
        //user
        $user = User::factory()->create();
        $user->givePermissionTo("update lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
        ];
        //create course
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => basename($filePath),
            "url" => md5(uniqid(rand(), true)),
            "price" => 20.99,
            "user_id" => $user->id,
        ]);
        //adding categories to the course
        $course->categories()->attach($idCategory);
        Storage::disk('public')->assertExists("images/" . basename($filePath));

        //Imagen nueva
        $fileUpdated = UploadedFile::fake()->image('imageUpdated.jpg')->size(15);
        $fileUpdatedPath = $fileUpdated->store("images", "public");

        $response = $this->actingAs($user)->put(route("update-courses", $course->id), [
            "title" => "Curso sobre desarrollo",
            "description" => "Updated description text.",
            "image_uri" => $fileUpdated,
            "url" => $course->url,
            "price" => 8,
            "user_id" => $user->id,
            "category_id" => "3, 4, 5"
        ]);
        $response->assertStatus(302);

        Storage::disk('public')->assertMissing("images/" . basename($filePath));
        // Verificar que la nueva imagen fue subida
        Storage::disk('public')->assertExists('images/' . basename($fileUpdatedPath));

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'title' => 'Curso sobre desarrollo',
            'description' => 'Updated description text.',
            'price' => 8,
            'user_id' => $user->id,
        ]);
    }

    public function test_can_remove_a_course(): void 
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-image.jpg')->size(15);
        $filePath = $file->store("images", "public");
        $user = User::factory()->create();
        $user->givePermissionTo("delete lessons");

        $idCategory = [
            0 => "1",
            1 => "2",
        ];
        
        $course = Course::create([
            "title" => "Course about food",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            "image_uri" => basename($filePath),
            "url" => md5(uniqid(rand(), true)),
            "price" => 90,
            "user_id" => $user->id,
        ]);
        $course->categories()->attach($idCategory);
        Storage::disk('public')->assertExists('images/' . basename($filePath));

        $response = $this->actingAs($user)->delete(route("delete-courses", $course->id));
        $response->assertStatus(302);

        Storage::disk('public')->assertMissing("images/" . basename($filePath));

        $this->assertDatabaseMissing('courses', [
            'id' => $course->id
        ]);
    }
}