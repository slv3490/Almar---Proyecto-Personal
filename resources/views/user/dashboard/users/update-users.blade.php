@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section>
        <a href="{{ route('users.index') }}" class="boton">Volver</a>
        <div class="container-divs">
            <div class="div-left">
                <h4>Actualizar Rol Usuario</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
            </div>
            <div class="div-right">
                <form method="POST" action="{{ route('users.update-roles', $user->id) }}" class="formulario lessons-form">
                    @csrf
                    @method("PUT")
                    <div>
                        <div class="campo">
                            <label for="name">Nombre</label>
                            <input class="input-disabled" type="text" disabled id="name" value="{{ $user->name }}">
                        </div>
                        
                        <div class="campo">
                            <label for="last_name">Apellido</label>
                            <input class="input-disabled" type="text" disabled id="last_name" value="{{ $user->last_name }}">
                        </div>
                        
                        <div class="campo">
                            <label for="email">Email</label>
                            <input class="input-disabled" type="email" disabled id="email" value="{{ $user->email }}">
                        </div>
                        
                        <div class="campo">
                            <label>Rol</label>
                            <div class="categoryOptions">
                                <select  name="role_user">
                                    <option disabled selected>--Seleccionar--</option>
                                    @foreach ($roles as $role)
                                        <option {{ ($user->roles[0]->id == $role->id) ? "selected" : "" }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Actualizar Rol" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                </form>
            </div>
        </div>
    </section>
</div>
@endsection