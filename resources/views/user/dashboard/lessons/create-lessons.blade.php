@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section>
        <a href="{{ route('lesson.lesson', $course->url) }}" class="boton">Volver</a>
        <div class="container-divs">
            <div class="div-left">
                <h4>Crear Lecciones</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
            </div>
            <div class="div-right">
                <form method="POST" action="{{ route('store-lessons', $course->id) }}" class="formulario lessons-form">
                    @csrf
                    @method("POST")

                    <div>
                        <div class="campo">
                            <label for="title">Título Lección</label>
                            <input type="text" id="title" placeholder="Ej: Abogados" name="title" value="{{ old("title") }}">
                        </div>
                        @error('title') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <label for="description">Descripción</label>
                            <input type="text" id="description" placeholder="Ej: Abogados" name="description" value="{{ old("description") }}">
                        </div>
                        @error('description') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <label for="content_uri">Contenido</label>
                            <input type="text" id="content_uri" placeholder="Url de la clase subida a youtube" name="content_uri" value="{{ old("content_uri") }}">
                        </div>
                        @error('content_uri') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Crear Lección" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                </form>
            </div>
        </div>
    </section>
</div>
@endsection