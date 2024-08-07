@extends('layouts.base')

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section>
        <a href="{{ route('lesson.lesson', ["id" => $course->id, "courseUrl" => $course->url]) }}" class="boton">Volver</a>
        <div class="container-divs">
            <div class="div-left">
                <h4>Actualizar Lecciones</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
            </div>
            <div class="div-right">
                <form method="POST" action="{{ route('update-lessons', ["id" => $lesson->id, "courseUrl" => $course->url]) }}" class="formulario lessons-form" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <x-forms.lesson :lesson="$lesson"/>

                    <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Actualizar Lección" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}" id="createLesson">
                </form>
            </div>
        </div>
    </section>
</div>

@endsection