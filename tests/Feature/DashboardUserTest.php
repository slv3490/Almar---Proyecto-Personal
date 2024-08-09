<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardUserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_dashboard_user_page_and_all_users(): void
    {
        $user = User::factory()->create();
        $user->assignRole("admin");

        $response = $this->actingAs($user)->get(route("users.index"));
        
        $response->assertViewIs("user.dashboard.users.index");
        $response->assertViewHas([
            "title" => "Users"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }
    public function test_can_see_dashboard_user_update_role_page(): void
    {
        $user = User::factory()->create();
        $user->assignRole("admin");
        $user->givePermissionTo("read roles");

        $response = $this->actingAs($user)->get(route("users.show-roles", $user->id));
        
        $response->assertViewIs("user.dashboard.users.update-users");
        $response->assertStatus(200);
        $user->delete();
    }

    public function test_can_update_user_role(): void
    {
        $user1 = User::factory()->create();
        $user1->assignRole("admin");
        $user1->givePermissionTo("update roles");
        $user2 = User::factory()->create();
        $user2->assignRole("spectator");
        
        $response = $this->actingAs($user1)->put(route("users.update-roles", $user2->id), [
            "role_user" => "2"
        ]);
        
        $response->assertStatus(302);
        $response->assertRedirect(route("users.index"));
        $user1->delete();
        $user2->delete();
    }
}
