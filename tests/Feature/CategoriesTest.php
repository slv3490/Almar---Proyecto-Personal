<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tests\DeleteUser;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_non_enter_to_the_category_index_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("categories.index"));
        $response->assertStatus(401);
        $user->delete();
    }
    public function test_can_non_enter_to_the_create_category_page_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("create-categories"));
        $response->assertStatus(401);
        $user->delete();
    }
    public function test_can_see_category_page_and_all_categories(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("read categories");

        $response = $this->actingAs($user)->get(route("categories.index"));
        $response->assertStatus(200);
        $response->assertViewIs("user.dashboard.categories.index");
        $response->assertViewHas(["categories" => Category::all(), "title" => "Categories"]);

        $user->delete();
    }
    public function test_get_all_categories(): void
    {
        $response = $this->getJson("/api/categories-query");
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "0" => [
                "*" => [
                    "id", 
                    "name"
                ]
            ]
        ]);
    }

    public function test_can_see_create_category_page(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("read categories");

        $response = $this->actingAs($user)->get(route("create-categories"));
        $response->assertStatus(200);
        $response->assertViewIs("user.dashboard.categories.create-categories");
        $response->assertViewHas("title", "Categories");

        $user->delete();
    }

    public function test_can_create_a_new_category(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("create categories");

        $response = $this->actingAs($user)->post(route("store-categories"), [
            "name" => "Music"
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route("categories.index"));
        $response->assertSessionHas("message", "¡Categoria creada exitosamente!");

        $user->delete();
    }

    public function test_can_edit_category_name(): void
    {
        $category = Category::create([
            "name" => "New Category"
        ]);

        $response = $this->postJson("/api/update-category/" . $category->id, [
            "name" => "Software"
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "0" => [
                "id", 
                "name"
            ]
        ]);

        $category->delete();
    }
    public function test_can_delete_category(): void
    {
        $category = Category::create([
            "name" => "New Category"
        ]);

        $response = $this->deleteJson("/api/delete-category/" . $category->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing("categories", [
            "id" => $category->id,
            "name" => $category->name
        ]);
    }
}