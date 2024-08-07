@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>

        <section>
            <a href="{{ route('roles.index') }}" class="boton">Volver</a>
            <div class="container-divs">
                <div class="div-left">
                    <h4>Crear Roles</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
                </div>
                <div class="div-right">
                    <form method="POST" action="{{ route('store-roles') }}" class="formulario">
                        @csrf
                        <div class="campo">
                            <label for="name">Nombre Rol</label>
                            <input type="text" id="name" placeholder="Ej: editor" name="name">
                        </div>
                        @error('name') <p class="error">{{ $message }}</p> @enderror

                        <div class="campo">
                            <label>Permisos</label>
                            <div class="rolesOptions">
                                <select id="select-roles">
                                    <option disabled selected>--Seleccionar--</option>
                                </select>
                                <input id="roles_lesson" type="hidden" name="roles">
                                
                                <button type="button" class="boton-sm" id="buttonAddRole">Add</button>
                            </div>
                        </div>

                        <p class="error error-roles-options"></p>
                        
                        <div class="campo">
                            <ul id="rolesList"></ul>
                        </div>
                        
                        <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Crear Rol" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}" id="createRole">
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection