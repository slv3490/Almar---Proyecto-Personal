<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_see_all_roles_and_their_permissions(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("read roles");

        $response = $this->actingAs($user)->get(route("roles.index"));

        $response->assertStatus(200);
        $response->assertViewIs("user.dashboard.roles.index");
        $response->assertViewHas([
            "title" => "Roles",
            "roles" => Role::all()
        ]);
    }

    public function test_can_not_see_roles_page_if_you_do_not_the_necessary_permissions() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route("roles.index"));

        $response->assertStatus(401);
    }

    public function test_can_create_role_and_add_permission_to_them(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("create roles");

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);

        $response = $this->actingAs($user)->post(route("store-roles"), [
            "name" => "new Role",
            "roles" => $permission1->id . "," . $permission2->id
        ]);
        $response->assertRedirect(route("roles.index"));
        $response->assertSessionHas("message", "¡Rol creado exitosamente!");

        $this->assertDatabaseHas("roles", ["name" => "new Role"]);

        $role = Role::where("name", "new Role")->first();

        // Verificar que los permisos fueron asignados al rol
        $this->assertTrue($role->hasPermissionTo($permission1->name));
        $this->assertTrue($role->hasPermissionTo($permission2->name));
        
        $role->delete();
        $role->revokePermissionTo($permission1);
        $role->revokePermissionTo($permission2);
        $permission1->delete();
        $permission2->delete();
    }

    public function test_can_not_create_roles_if_you_do_not_have_the_necessary_permissions() : void
    {
        $user = User::factory()->create();

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);

        $response = $this->actingAs($user)->post(route("store-roles"), [
            "name" => "new Role",
            "roles" => $permission1->id . "," . $permission2->id
        ]);

        $this->assertDatabaseMissing("roles", ["name" => "new Role"]);

        $response->assertStatus(401);
        $permission1->delete();
        $permission2->delete();
    }

    public function test_can_update_role_and_add_permission_to_them(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("update roles");

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);
        $permission3 = Permission::create(["name" => "Master"]);
        $permission4 = Permission::create(["name" => "Lead"]);

        $role = Role::create(["name" => "new Role"]);
        $role->syncPermissions([$permission1, $permission2]);

        $response = $this->actingAs($user)->put(route("update-roles", $role->id), [
            "name" => "Role",
            "roles" => $permission3->id . "," . $permission4->id
        ]);
        $response->assertRedirect(route("roles.index"));

        $this->assertDatabaseHas("roles", ["name" => "Role"]);

        $role = Role::where("name", "Role")->first();

        // Verificar que los permisos fueron asignados al rol
        $this->assertTrue($role->hasPermissionTo($permission3->name));
        $this->assertTrue($role->hasPermissionTo($permission4->name));
        
        $role->delete();
        $role->revokePermissionTo($permission3);
        $role->revokePermissionTo($permission4);
        $permission1->delete();
        $permission2->delete();
        $permission3->delete();
        $permission4->delete();
    }

    public function test_can_not_update_role_and_permissions_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);
        $permission3 = Permission::create(["name" => "Master"]);
        $permission4 = Permission::create(["name" => "Lead"]);

        $role = Role::create(["name" => "new Role"]);
        $role->syncPermissions([$permission1, $permission2]);

        $response = $this->actingAs($user)->put(route("update-roles", $role->id), [
            "name" => "Role",
            "roles" => $permission3->id . "," . $permission4->id
        ]);
        $response->assertStatus(401);

        $this->assertDatabaseHas("roles", ["name" => "new Role",]);
        $this->assertDatabaseMissing("roles", ["name" => "Role",]);

        $role = Role::where("name", "new Role")->first();

        // Verificar que los permisos fueron asignados al rol
        $this->assertTrue($role->hasPermissionTo($permission1->name));
        $this->assertTrue($role->hasPermissionTo($permission2->name));
        
        $role->delete();
        $role->revokePermissionTo($permission1);
        $role->revokePermissionTo($permission2);
        $permission1->delete();
        $permission2->delete();
        $permission3->delete();
        $permission4->delete();
    }

    public function test_can_delete_roles(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo("delete roles");

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);

        $role = Role::create([
            "name" => "new Role",
            "roles" => $permission1->id . "," . $permission2->id
        ]);

        $response = $this->actingAs($user)->delete(route("delete-roles", $role->id));
        $response->assertRedirect(route("roles.index"));

        $this->assertDatabaseMissing("roles", ["name" => "new Role"]);
 
        $permission1->delete();
        $permission2->delete();
    }

    public function test_can_not_delete_roles_if_you_do_not_have_the_necessary_permissions(): void
    {
        $user = User::factory()->create();

        $permission1 = Permission::create(["name" => "Scrum Master"]);
        $permission2 = Permission::create(["name" => "Tech Lead"]);

        $role = Role::create(["name" => "new Role"]);
        $role->syncPermissions([$permission1, $permission2]);

        $response = $this->actingAs($user)->delete(route("delete-roles", $role->id));
        $response->assertStatus(401);

        $this->assertDatabaseHas("roles", ["name" => "new Role",]);

        $this->assertTrue($role->hasPermissionTo($permission1->name));
        $this->assertTrue($role->hasPermissionTo($permission2->name));
 
        $role->delete();
        $permission1->delete();
        $permission2->delete();
    }
}
