@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section> 
        <header class="header-roles">
            <div class="user-description">
                <h4>Usuarios</h4>
                <p>Una lista de todos los usuarios de su cuenta, incluyendo su nombre completo, correo electrónico y rol.</p>
            </div>
        </header>
        
        <table class="table-users-roles">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    @if (Auth::user()->hasAnyPermission(["read roles", "spectator"]))
                        <th>Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()[0] }}</td>
                        @if (Auth::user()->hasAnyPermission(["read roles", "spectator"]))
                            <td>
                                <div class="actions actions-user-role">
                                    <a href="{{ route('users.show-roles', $user->id) }}" class="button-edit">Edit</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection