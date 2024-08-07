<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UpdateUserAccountForm extends Form
{
    #[Validate('required', message: "EL campo de nombre es obligatorio")] 
    public $name;

    #[Validate('required', message: "El campo de apellido es obligatorio")] 
    public $last_name;

    #[Validate('required', message: "El campo de E-Mail es obligatorio")]
    #[Validate('email', message: "El campo de E-Mail debe ser una direccion de correo valido")]
    public $email;
    public $oldPassword;
    public $password;
}
