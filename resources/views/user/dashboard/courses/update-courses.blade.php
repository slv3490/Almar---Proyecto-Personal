@extends("layouts.base")

@section('content')
<div class="contenedor dashboard">
    <x-dashboard-component :title="$title"/>

    <section>
        <a href="{{ route('course.index') }}" class="boton">Volver</a>
        <div class="container-divs">
            <div class="div-left">
                <h4>Actualizar Curso</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
            </div>
            <div class="div-right">
                <form method="POST" action="{{ route('update-courses', $course->id) }}" class="formulario lessons-form" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div>
                        <div class="campo">
                            <label for="title">Título Curso</label>
                            <input type="text" id="title" placeholder="Ej: Abogados" name="title" value="{{ $course->title }}">
                        </div>
                        @error('title') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <label for="description">Descripción</label>
                            <input type="text" id="description" placeholder="Ej: Abogados" name="description" value="{{ $course->description }}">
                        </div>
                        @error('description') <p class="error">{{ $message }}</p> @enderror

                        <div class="campo">
                            <label for="price">Precio</label>
                            <input type="number" id="price" placeholder="Ej: 77.99" name="price" value="{{ $course->price }}">
                        </div>
                        @error('price') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <label for="image">Imagen</label>
                            <input type="file" id="image" name="image_uri">
                        </div>
                        @error('image_uri') <p class="error">{{ $message }}</p> @enderror
                        
                        <div class="campo">
                            <label>Categorias</label>
                            <div class="categoryOptions">
                                <select id="seleccionar-categorias">
                                    <option disabled selected>--Seleccionar--</option>
                                </select>
                                <input id="category_lesson" type="hidden" name="category_id" value="@foreach($course->categories as $category){{ $category->id}},@endforeach">
                                
                                <button type="button" class="boton-sm" id="buttonAdd">Add</button>
                            </div>
                        </div>
                        
                        <p class="error error-category-options"></p>
                        
                        <div class="campo">
                            <ul id="categoriesList"></ul>
                        </div>
                    </div>

                    <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Actualizar Curso" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}" id="createCourse">
                </form>
            </div>
        </div>
    </section>
</div>
@endsection