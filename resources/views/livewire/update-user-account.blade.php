<div class="edit-profile">
    <h1 class="mb-3 mt-3">Editar Perfil</h1>

    <form class="formulario" wire:submit="updateUserAccount" method="POST">
        @csrf
        @method("PUT")
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input wire:model.live="user.name" type="text" placeholder="{{ Auth::user()->name }}" id="nombre">
        </div>
        <div class="error">@error('user.name') {{ $message }} @enderror</div>

        <div class="campo">
            <label for="apellido">Apellido</label>
            <input wire:model.live="user.last_name" type="text" placeholder="{{ Auth::user()->last_name }}" id="apellido">
        </div>
        <div class="error">@error('user.last_name') {{ $message }} @enderror</div>

        <div class="campo">
            <label for="email">Email</label>
            <input wire:model.live="user.email" type="email" placeholder="{{ Auth::user()->email }}" id="email">
        </div>
        <div class="error">@error('user.email') {{ $message }} @enderror</div>

        <div class="campo">
            <label for="oldPassword">Contraseña Anterior</label>
            <input wire:model.live="user.oldPassword" type="password" placeholder="Ej: 123456" id="oldPassword">
        </div>
        <div class="error">@error('user.oldPassword') {{ $message }} @enderror</div>
        @if (session()->has('noMatch'))
            <div class="alert alert-success">
                {{ session('noMatch') }}
            </div>
        @endif

        <div class="campo">
            <label for="password">Contraseña Nueva</label>
            <input wire:model.live="user.password" type="password" placeholder="Ej: 654321" id="password">
        </div>
        <div class="error">@error('user.password') {{ $message }} @enderror</div>

        <input type="submit" value="Crear Cuenta" class="boton">
    </form>
</div>
