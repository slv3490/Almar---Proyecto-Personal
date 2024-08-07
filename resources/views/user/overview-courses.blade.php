@extends("layouts.base")

@section('content')

<section class="section-overview">
    <h2 class="title">{{ $course->title }}</h2>
    <div class="video-course">
        <div class="container-responsive-iframe">
            <iframe class="responsive-iframe" src="{{ $lessonVideo->content_uri }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="div-index-course">
            <p class="index-course-video">Contenido del curso</p>
            @foreach ($course->lessons as $lesson)
                <div class="list-video-course {{ $lesson->id == $lessonVideo->id ? "activo" : "" }}">
                    <a href="{{ route('courses.watch', ['courseUrl' => $course->url, 'lesson' => $lesson->id]) }}">
                        <p>{{ $lesson->title }}</p> 
                    </a>
                </div>
            @endforeach
        </div>
        <p class="lesson-title">{{ $lessonVideo->title }}</p>

        <div class="description-course">
            <h4>Descripción del curso</h4>
            <p>{{ $course->description }}</p>

            <h4>Tutor del curso</h4>
            <p>{{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
        </div>
        {{-- <p>{{ $course->description }}</p> --}}
    </div>
    </section>
@endsection