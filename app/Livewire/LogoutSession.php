<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutSession extends Component
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route("index");
    }
}
