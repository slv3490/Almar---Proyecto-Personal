<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view("user.dashboard.roles.index", [
            "title" => "Roles",
            "roles" => $roles
        ]);
    }

    public function createRoles()
    {
        return view("user.dashboard.roles.create-roles", [
            "title" => "Roles"
        ]);
    }

    public function storeRoles(RoleRequest $request)
    {
        $result = Role::create([
            "name" => $request->name
        ]);

        if($result) {
            $idPermission = explode(",", $request->roles);
            $arrayFilterPermissions = [];
            
            foreach ($idPermission as $key => $value) {
                $arrayFilterPermissions[] = Permission::findById($value);
            }
            
            $result->syncPermissions($arrayFilterPermissions);

            return redirect()->route("roles.index")->with("message", "¡Rol creado exitosamente!");
        }
    }
    public function showRoles($id) {
        $role = Role::findById($id);

        $permissions = $role->permissions;

        return view("user.dashboard.roles.update-roles", [
            "title" => "Roles",
            "role" => $role,
            "permissions" => $permissions
        ]);
    }
    public function updateRoles(Request $request, $id) {
        $request->validate([
            "name" => ["required", "max:100"],
            "roles" => ["required", "max:150"]
        ]);

        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();

        if($request->roles !== null) {
            $rtrimIdRole = rtrim($request->roles, ",");
            $idRole = explode(",", $rtrimIdRole);
            
            $role->permissions()->sync($idRole);
            
            $role->save();
    
            return redirect()->route("roles.index");
        }
    }
    public function deleteRole($id) {
        $role = Role::findById($id);
        if($role) {
            $role->delete();
            return redirect()->route("roles.index");            
        }
    }
}
