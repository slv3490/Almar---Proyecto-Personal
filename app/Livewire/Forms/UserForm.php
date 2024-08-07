<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;

class UserForm extends Form
{
    #[Validate('required', message: "EL campo de nombre es obligatorio")] 
    public $name;

    #[Validate('required', message: "El campo de apellido es obligatorio")] 
    public $last_name;

    #[Validate('required', message: "El campo de E-Mail es obligatorio")]
    #[Validate('email', message: "El campo de E-Mail debe ser una direccion de correo valido")]
    public $email;

    #[Validate('required', message: "El campo de contraseña es obligatorio")] 
    #[Validate('min:6', message: "La contraseña debe tener un minimo de 6 caracteres")]
    public $password;

}