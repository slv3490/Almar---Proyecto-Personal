<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\CreateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DeleteUser;

class CreateAccountTest extends TestCase
{
    public function test_can_see_create_account_page(): void
    {
        $response = $this->get(route("user.create"));

        $response->assertStatus(200);
        $response->assertViewIs("user.create");
    }

    protected function deleteUser($userEmail) {
        $userFind = User::where("email", $userEmail);
        $userFind->delete();
    }

    public function test_can_create_user_account(): void 
    {
        Livewire::test(CreateUser::class)
            ->set("user.name", "Nuevo Usuario")
            ->set("user.last_name", "Apellido")
            ->set("user.email", "usuario@example.com")
            ->set("user.password", "nuevousuario")
            ->call("create")
            ->assertRedirect(route("dashboard"))
            ->assertStatus(200);

        $this->assertDatabaseHas("users", [
            "email" => "usuario@example.com"
        ]);

        $this->deleteUser("usuario@example.com");
    }
}
