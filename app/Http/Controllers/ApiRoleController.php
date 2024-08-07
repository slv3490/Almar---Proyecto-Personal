<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class ApiRoleController extends Controller
{
    public static function rolesQuery()
    {
        $permissions = Permission::all();

        return response()->json([
            $permissions
        ], 200);
    }
}
