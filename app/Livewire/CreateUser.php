<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\UserForm;
use Illuminate\Support\Facades\Auth;

class CreateUser extends Component
{

    public UserForm $user;

    public function create()
    {
        $this->validate();
        
        $user = User::create($this->user->all());

        Auth::login($user);

        return redirect()->route("dashboard");
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
