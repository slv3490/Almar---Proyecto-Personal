<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        return view("user.dashboard.dashboard", [
            "title" => "Dashboard"
        ]);
    }

    //Roles
    public function createRoles(Request $request) 
    {
        
        return view("user.dashboard.create-roles", [
            "title" => "Crear Roles"
        ]);
    }
    public function storeRoles(Request $request) 
    {
        
    }

    //Permissions
    public function createPermissions() 
    {
        return view("user.dashboard.create-permissions", [
            "title" => "Crear Permisos"
        ]);
    }

    //Category
    public function createCategories() 
    {
        return view("user.dashboard.create-categories", [
            "title" => "Crear Categorias"
        ]);
    }
    
}