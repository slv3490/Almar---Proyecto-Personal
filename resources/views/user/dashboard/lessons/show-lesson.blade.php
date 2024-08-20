@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section class="container-sections-lesson">
        <a href="{{ route('course.index') }}" class="boton">Volver</a>
        @if (Auth::user()->hasAnyPermission(["create lessons", "spectator"]))
            <a href="{{ route('create-lessons', $course->id) }}" class="boton">Crear Lecciones</a>
        @endif

        <h2 class="mb-3 mt-3">{{ $course->title }}</h2>

        @if ($lessons->isEmpty())
            <h5 class="title-lesson">Todavía no has creado ninguna lección.</h5>
        @else
            <table class="table-users-roles">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ $lesson->description }}</td>
                            <td class="flex">
                                @if (Auth::user()->hasAnyPermission(["update lessons", "spectator"]))
                                    <a href="{{ route('show-lessons', ["id" => $lesson->id, "courseUrl" => $course->url]) }}" class="button-edit">Edit</a>
                                @endif
                                @if (Auth::user()->hasAnyPermission(["delete lessons", "spectator"]))
                                    <form action="{{ route('delete-lessons', ["id" => $lesson->id, "courseUrl" => $course->url]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Remove" class="button-remove {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        



        {{-- @forelse ($lessons as $lesson)
            <section class="section-lesson flex">
                <div class="container-lesson">
                    <h4 class="title-lesson">{{ $lesson->title }}</h4>
                    <p class="description-lesson">{{ $lesson->description }}</p>
                    
                    <div class="actions">
                        @if (Auth::user()->hasAnyPermission(["update lessons", "spectator"]))
                            <a href="{{ route('show-lessons', ["id" => $lesson->id, "courseUrl" => $course->url]) }}" class="button-edit">Edit</a>
                        @endif
                        @if (Auth::user()->hasAnyPermission(["delete lessons", "spectator"]))
                            <form action="{{ route('delete-lessons', ["id" => $lesson->id, "courseUrl" => $course->url]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Remove" class="button-remove {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                            </form>
                        @endif --}}
                        {{-- <a href="#" class="button-go-to-lesson">Ir a la lección</a> --}}
                    {{-- </div>
                </div>
            </section> --}}
        {{-- @empty
            <h4 class="title-lesson">Todavía no has creado ninguna lección.</h4>
        @endforelse --}}
    </section>
</div>
@endsection