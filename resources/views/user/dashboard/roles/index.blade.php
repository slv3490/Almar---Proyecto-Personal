@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section class="section-roles">
        <header class="header-roles">
            <div class="user-description">
                <h4>Roles</h4>
                <p>Una lista de todos los roles de su cuenta, incluyendo los permisos asociados al mismo</p>
            </div>
            @if (Auth::user()->hasAnyPermission(["create roles", "spectator"]))
                <a href="{{ route('create-roles') }}" class="boton">Crear Rol</a>
            @endif
        </header>
        
        <table class="table-users-roles">
            <thead>
                <tr>
                    <th>Roles</th>
                    <th>Permisos</th>
                    @if (Auth::user()->hasAnyPermission(["update roles", "spectator"]))
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td class="container-permission-name">
                            @foreach ($role->permissions as $permission)
                                <p class="button-permission-name">{{ $permission->name }}</p>
                            @endforeach
                        </td>
                        @if (Auth::user()->hasPermissionTo("update roles") || Auth::user()->hasPermissionTo("delete lessons") || Auth::user()->hasPermissionTo("spectator"))
                            <td>
                                <div class="actions actions-user-role">
                                    @if (Auth::user()->hasAnyPermission(["update roles", "spectator"]))
                                    <a href="{{ route('update-roles', $role->id) }}" class="button-edit">Edit</a>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(["delete lessons", "spectator"]))
                                        <form action="{{ route('delete-roles', $role->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Remove" class="button-remove {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                                        </form>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="section-permissions">
        <h4>Permisos</h4>
        <p>Una lista de todos los permisos, incluyendo una breve descripción</p>
        {{-- Categories --}}
        <div class="container-section-permissions">
            <div class="section-permissions-roles">
                <h5>Categorias</h5>
                <ol>
                    <div class="order-list-permissions">
                        <li class="bold">Create Categories:</li>
                        <ul>
                            <li>Acción de crear nuevas categorías en un sistema, que sirven para organizar y clasificar contenidos, roles, lecciones u otros elementos.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Read Categories:</li>
                        <ul>
                            <li>Acción de consultar o visualizar las categorías existentes, viendo su estructura y los elementos asociados a cada una.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Update Categories:</li>
                        <ul>
                            <li>Acción de modificar las categorías existentes, cambiando su nombre, descripción o los elementos asociados a ellas.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Delete Categories:</li>
                        <ul>
                            <li>Acción de eliminar categorías del sistema, reorganizando o eliminando los elementos que estaban asociados a ellas.</li>
                        </ul>
                    </div>
                </ol>
            </div><!-- Categories -->

            {{-- Roles --}}
            <div class="section-permissions-roles">
                <h5>Roles</h5>
                <ol>
                    <div class="order-list-permissions">
                        <li class="bold">Create Roles:</li>
                        <ul>
                            <li>Acción de crear nuevos roles en un sistema, definiendo las responsabilidades y permisos que tendrán los usuarios asignados a esos roles.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Read Roles:</li>
                        <ul>
                            <li>Acción de crear nuevos roles en un sistema, definiendo las responsabilidades y permisos que tendrán los usuarios asignados a esos roles.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Update Roles:</li>
                        <ul>
                            <li>Acción de crear nuevos roles en un sistema, definiendo las responsabilidades y permisos que tendrán los usuarios asignados a esos roles.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Delete Roles:</li>
                        <ul>
                            <li>Acción de crear nuevos roles en un sistema, definiendo las responsabilidades y permisos que tendrán los usuarios asignados a esos roles.</li>
                        </ul>
                    </div>
                </ol>
            </div> <!-- Categories -->

            {{-- Lessons --}}

            <div class="section-permissions-roles">
                <h5>Lecciones</h5>
                <ol>
                    <div class="order-list-permissions">
                        <li class="bold">Create Lessons:</li>
                        <ul>
                            <li>Acción de crear nuevas lecciones en un sistema educativo o plataforma de aprendizaje, definiendo su contenido, objetivos y recursos asociados.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Read Lessons:</li>
                        <ul>
                            <li>Acción de consultar o visualizar las lecciones existentes, accediendo a su contenido y recursos educativos.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Update Lessons:</li>
                        <ul>
                            <li>Acción de modificar lecciones existentes, cambiando su contenido, estructura o recursos asociados.</li>
                        </ul>
                    </div>
                    <div class="order-list-permissions">
                        <li class="bold">Delete Lessons:</li>
                        <ul>
                            <li>Acción de eliminar lecciones del sistema, removiendo su contenido y recursos educativos.</li>
                        </ul>
                    </div>
                </ol>
            </div> <!-- Lessons -->
        </div>
    </section>
</div>
@endsection