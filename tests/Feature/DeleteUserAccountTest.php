<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DeleteUser;

class DeleteUserAccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_user_profile_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route("user.profile"));

        $response->assertStatus(200);
        $response->assertViewIs("user.profile.profile");

        $user->delete();
    }

    public function test_can_delete_user_account(): void 
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route("delete.user.account", $user->id));
        
        $this->assertDatabaseMissing("users", [
            "email" => $user->email
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route("index"));
        $user->delete();
    }
}