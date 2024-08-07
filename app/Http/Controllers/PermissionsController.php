<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return view("user.dashboard.permissions.index", [
            "title" => "Permisos"
        ]);
    }

    public function createPermissions()
    {
        return view("user.dashboard.permissions.create-permissions", [
            "title" => "Permisos"
        ]);
    }

    public function storeRoles(Request $request)
    {
        
    }
}
