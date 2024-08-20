@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard container-course">
        <x-dashboard-component :title="$title"/>
        <h2 class="mt-3 mb-3">Mis Cursos</h2>
        @if ($courses->isEmpty())
            <p class="centrar-texto">No hay cursos comprados.</p>
        @else
            @foreach ($courses as $course)
                <div class="course-parent">
                    <a href="{{ route('courses.watch', ['courseUrl' => $course->url, 'lesson' => $course->lessons->first()->id]) }}" class="course section-course">
                        <img src="{{ asset('storage/images/'.$course->image_uri) }}" class="image-course">
                        <div>
                            <h3 class="text-left title-course">{{ $course->title }}</h3>
                            <p class="description-course">{{ $course->description }}</p>
                            <div class="flex itemsCategories">
                                @foreach ($course->categories as $category)
                                    <p class="idListCategories">{{ $category->name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @endif

        <h2>Favoritos</h2>

        <div><p class="centrar-texto">In Process</p></div>
    </div>
@endsection

<script>
    const apiToken = "{{ session('api_token') }}";

    localStorage.setItem('token', apiToken);
</script>