@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>

        <section>
            <a href="{{ route('roles.index') }}" class="boton">Volver</a>
            <div class="categorias">
                <div class="categorias-info">
                    <h4>Actualizar Roles</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
                </div>
                <div class="categorias-form">
                    <form method="POST" action="{{ route('update-roles', $role->id) }}" class="formulario">
                        @csrf
                        @method("PUT")
                        <div class="campo">
                            <label for="name">Nombre Rol</label>
                            <input type="text" id="name" placeholder="Ej: editor" name="name" value="{{ $role->name }}">
                        </div>

                        <div class="campo">
                            <label>Permisos</label>
                            <div class="rolesOptions">
                                <select id="select-roles">
                                    <option disabled selected>--Seleccionar--</option>
                                </select>
                                <input id="roles_lesson" type="hidden" name="roles" value="@foreach($permissions as $permission){{ $permission->id}},@endforeach">
                                
                                <button type="button" class="boton-sm" id="buttonAddRole">Add</button>
                            </div>
                        </div>

                        @error('roles') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <ul id="rolesList"></ul>
                        </div>
                        
                        <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Actualizar Rol" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection