<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function deleteUserAccount($id) {
        $user = User::find($id);

        return response()->json([
            "user" => $user,
            "success" => 200
        ]);
    }
}
