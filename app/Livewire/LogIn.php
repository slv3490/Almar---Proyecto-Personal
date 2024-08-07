<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\LogInForm;
use Illuminate\Support\Facades\Auth;

class LogIn extends Component
{
    public LogInForm $session;
    public $spectator;

    public function login()
    {
        if($this->spectator) {
            if(Auth::attempt(["email" => "espectador@espectador.com", "password" => "espectador"])) {
                return redirect()->route("dashboard");
            }
        }
        $this->validate();

        if(Auth::attempt(['email' => $this->session->email, 'password' => $this->session->password])) {
            return redirect()->route("dashboard");
        } else {
            session()->flash('errors', 'Los datos no coinciden con nuestras credenciales.');
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
