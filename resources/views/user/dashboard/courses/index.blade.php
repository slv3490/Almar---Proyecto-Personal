@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    @if (Auth::user()->hasAnyPermission(["create lessons", "spectator"]))
        <a href="{{ route('create-courses') }}" class="boton">Crear Cursos</a>
    @endif

    <section>
        @foreach ($courses as $course)
            <section class="section-course flex">
                <img class="image-course" width="200px" src="{{ asset('storage/images/'.$course->image_uri) }}" alt="">
                
                <div class="container-course">
                    <h4 class="title-course">{{ $course->title }}</h4>
                    <p class="description-course">{{ $course->description }}</p>
                    <div class="flex itemsCategories">
                        @foreach ($course->categories as $category)
                            <p class="idListCategories">{{ $category->name }}</p>
                        @endforeach
                    </div>
                    
                    <div class="actions">
                        @if (Auth::user()->hasAnyPermission(["update lessons", "spectator"]))
                            <a href="{{ route('show-courses', $course->id) }}" class="button-edit">Edit</a>
                        @endif
                        @if (Auth::user()->hasAnyPermission(["delete lessons", "spectator"]))
                            <form action="{{ route('delete-courses', $course->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Remove" class="button-remove {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                            </form>
                        @endif
                        <a href="{{ route('lesson.lesson', $course->url) }}" class="button-go-to-lesson">Ir al Curso</a>
                    </div>
                </div>
            </section>
        @endforeach

        {{ $courses->links() }}
    </section>
</div>
@endsection