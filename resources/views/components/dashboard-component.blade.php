<div class="seccion-dashboard">
    <a class="{{ ($title == 'Dashboard') ? 'activo' : '' }}" href="{{ route("dashboard") }}"><p><b>Dashboard</b></p></a>

    @if (Auth::user()->hasPermissionTo("user"))
        <a class="{{ ($title === 'MyCourses') ? 'activo' : '' }}" href="#"><p>Mis Cursos</p></a>
        <a class="{{ ($title === 'Favorites') ? 'activo' : '' }}" href="#"><p>Favoritos</p></a>
    @endif

    @if (Auth::user()->hasAnyPermission(["read roles", "spectator"]))
        <a class="{{ ($title === 'Roles') ? 'activo' : '' }}" href="{{ route("roles.index") }}"><p>Roles y Permisos</p></a>
    @endif

    @if (Auth::user()->hasAnyPermission(["read roles", "spectator"]))
        <a class="{{ ($title === 'Users') ? 'activo' : '' }}" href="{{ route("users.index") }}"><p>Usuarios</p></a>
    @endif

    @if (Auth::user()->hasAnyPermission(["read lessons", "spectator"]))
        <a class="{{ ($title === 'Courses') ? 'activo' : '' }}" href="{{ route("course.index") }}"><p>Cursos</p></a>
    @endif

    @if (Auth::user()->hasAnyPermission(["read categories", "spectator"]))
        <a class="{{ ($title === 'Categories') ? 'activo' : '' }}" href="{{ route("categories.index") }}"><p>Categorias</p></a>
    @endif
</div>