<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class RememberPassword extends Component
{
    public UserForm $user;

    public function submit()
    {
        $this->validate();

        
    }

    public function render()
    {
        return view('livewire.remember-password');
    }
}
