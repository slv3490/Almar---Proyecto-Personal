<?php

namespace Tests;

use App\Models\User;

trait DeleteUser {
    public function deleteUser($userEmail) {
        $userFind = User::where("email", $userEmail);
        $userFind->delete();
    }
}