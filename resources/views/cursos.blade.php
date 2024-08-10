@extends('layouts.base')

@section('content')

    <div class="contenedor container-course">
        <div>
            <h1>Cursos</h1>
            <p class="centrar-texto">Aprende lo que desees gracias a nuestros profesionales altamente cualificados que te acompañaran en tu viaje.</p>
            <div class="search-courses">
                <form action="{{ route('cursos') }}" method="GET">
                    <div class="flex input">
                        <img class="search-icon" src="{{ Vite::asset('resources/img/search-icon.svg') }}" alt="Icon Search">
                        <input name="search" type="text" placeholder="Buscar Cursos" >
                    </div>
                </form>
            </div>
        </div>

        <section class="flex">
            <div class="filter-checkbox">
                <h3 class="mb-2">Filtrar</h3>
                <form action="{{ route('cursos') }}" method="GET">
                    @foreach ($categories as $category)
                        <div class="field-filter-categories">
                            
                            <input 
                                type="checkbox"  
                                name="category[]" 
                                id="{{ $category->id }}" 
                                value="{{ $category->id }}"
                                @if (!empty($_GET["category"]))
                                    @foreach ($_GET["category"] as $checked)
                                        {{ $checked == $category->id ? "checked" : "" }}
                                    @endforeach    
                                @endif
                            >
                            <label for="{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    @endforeach
                    <input type="submit" class="boton" value="Filtrar">
                </form>
            </div>
            <div id="showFilteredCourses">
                @if ($courses->isEmpty())
                    <p>No se ha podido encontrar el curso que buscas.</p>
                @endif
                @foreach ($courses as $course)
                    @if (!$course->lessons->isEmpty())
                        <a href="{{ route('courses.watch', ['courseUrl' => $course->url, 'lesson' => $course->lessons[0]->id]) }}" class="course section-course course-anchor">
                            <div class="flex">
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
                            </div>
                            <p class="bold course-price">{{ $course->price }} US$</p>
                        </a>
                    @endif
                @endforeach
                {{ $courses->links() }}
            </div>

        </section>
    </div>

@endsection