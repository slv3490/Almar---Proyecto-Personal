@extends('layouts.base')

@section('content')
    <div class="contenedor overview-lesson">
        <a href="{{ route('lessons.index') }}" class="boton">Volver</a>
        <h2>{{ $lesson->title }}</h2>
        <p>{{ $lesson->description }}</p>

        <div class="container-lesson">
            <iframe class="video-lesson" src="{{ $lesson->content_uri }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
@endsection