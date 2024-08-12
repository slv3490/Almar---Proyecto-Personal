<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\UserForm;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\UpdateUserAccountForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUserAccount extends Component
{
    public UpdateUserAccountForm $user;

    public function mount()
    {
        $user = Auth::user();
        if($user) {
            $this->user->name = $user->name;
            $this->user->last_name = $user->last_name;
            $this->user->email = $user->email;
        } else {
            abort(403);
        }
    }

    public function updateUserAccount()
    {
        $this->validate();

        $user = Auth::user();
        if($user) {
            $user->name = $this->user->name;
            $user->last_name = $this->user->last_name;
            $user->email = $this->user->email;
            if($this->user->password || $this->user->oldPassword) {
                if(password_verify($this->user->oldPassword, $user->password)) {
                    $user->password = Hash::make($this->user->password);
                } else {
                    session()->flash("noMatch", "El password no coincide");
                }
            }
            $user->save();
            return redirect()->route("dashboard");
        } else {
            abort(403);
        }
    }

    public function userNotAuthorized() {
        abort(401);
    }

    public function render()
    {
        return view('livewire.update-user-account');
    }
}
