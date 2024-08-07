<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\UpdateUserAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DeleteUser;

class UserProfileTest extends TestCase
{
    use DeleteUser;
    /**
     * A basic feature test example.
     */

    public function test_can_see_user_profile_page(): void
    {
        $user = User::factory()->create([
            'email' => 'example@example.com',
            'password' => 'passwordexample',
        ]);
        $response = $this->actingAs($user)->get(route("user.profile"));

        $response->assertStatus(200);
        $response->assertViewIs("user.profile.profile");

        $this->deleteUser("example@example.com");
    }

    public function test_can_edit_user_account(): void
    {
        $user = User::factory()->create();
        
        $response = Livewire::actingAs($user)
            ->test(UpdateUserAccount::class)
            ->set("user.name", "lucas")
            ->set("user.last_name", "Perez")
            ->set("user.email", "lucasperezspectador@gmail.com")
            ->call("updateUserAccount");

        $response->assertStatus(200);
        $this->deleteUser($user->email);
    }

    public function test_can_edit_password_user_account(): void
    {
        $user = User::factory()->create([
            "password" => 'currentpassword'
        ]);
        
        $response = Livewire::actingAs($user)
            ->test(UpdateUserAccount::class)
            ->set("user.oldPassword", "currentpassword")
            ->set("user.password", "123456789")
            ->call("updateUserAccount");
        
        $response->assertStatus(200);
        $this->assertTrue(password_verify('123456789', $user->password));
        $this->deleteUser($user->email);
    }

    public function test_it_does_not_update_password_if_old_password_is_incorrect(): void
    {

        $user = User::factory()->create([
            "password" => "currentpassword"
        ]);
        
        $response = Livewire::actingAs($user)
            ->test(UpdateUserAccount::class)
            ->set("user.oldPassword", "444444")
            ->set("user.password", "41142421124")
            ->call("updateUserAccount");
            
        $user->refresh();
        $this->assertTrue(password_verify("currentpassword", $user->password));
        $response->assertSessionHas("noMatch", "El password no coincide");

        $this->deleteUser($user->email);
    }

    public function test_it_does_not_update_password_if_old_password_is_empty(): void
    {

        $user = User::factory()->create([
            "password" => "currentpassword"
        ]);
        
        $response = Livewire::actingAs($user)
            ->test(UpdateUserAccount::class)
            ->set("user.oldPassword", "")
            ->set("user.password", "41142421124")
            ->call("updateUserAccount");
            
        $user->refresh();
        $this->assertTrue(password_verify("currentpassword", $user->password));
        $response->assertSessionHas("noMatch", "El password no coincide");

        $this->deleteUser($user->email);
    }
}