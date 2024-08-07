<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LogInForm extends Form
{
    #[Validate('required', message: "El campo de E-Mail es obligatorio")]
    #[Validate('email', message: "El campo de E-Mail debe ser una direccion de correo valido")]
    public $email = "";
    #[Validate('required', message: "El campo de contraseña es obligatorio")] 
    #[Validate('min:6', message: "La contraseña debe tener un minimo de 6 caracteres")]
    public $password = "";
}
