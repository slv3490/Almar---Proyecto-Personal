@extends('layouts.base')

@section('content')
    <main class="contenedor">
        {{-- Cursos --}}
        <section class="section-course-index-page">
            <h2>Cursos</h2>
            <p class="centrar-texto">¡Prueba alguno de nuestros cursos!</p>

            <div class="flex cursos-mostrar">
                <video muted loop autoplay src="{{ Vite::asset("resources/videos/cocina.mp4") }}"></video>

                <div class="contenedor-art-cursos">
                    <article >
                        <a class="flex articulo-curso" href="">
                            <img src="{{ Vite::asset("resources/img/curso-cocina.jpg") }}" alt=" curso de finanzas">
                            <div>
                                <h3>Cursos Sobre Cocina</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea vero iure vel, porro officia. Eum dolorum facere non</p>
                            </div>
                        </a>
                    </article>

                    <article >
                        <a class="flex articulo-curso" href="">
                            <img src="{{ Vite::asset("resources/img/curso-idiomas.jpg") }}" alt=" curso de finanzas">
                            <div>
                                <h3>Cursos Idiomas Extranjeros</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea vero iure vel, porro officia. Eum dolorum facere non</p>
                            </div>
                        </a>
                    </article>

                    <article>
                        <a class="flex articulo-curso" href="">
                            <img src="{{ Vite::asset("resources/img/curso-finanzas.jpg") }}" alt=" curso de finanzas">
                            <div>
                                <h3>Cursos Sobre Finanzas</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ea vero iure vel, porro officia. Eum dolorum facere non</p>
                            </div>
                        </a>
                    </article>
                </div>
            </div>
        </section> {{-- Cursos --}}

        <!-- Slider main container -->
        <h3 class="mb-5">Cursos recomendados</h3>
        <div class="swiper mySwiper slider-courses">
            <div class="swiper-wrapper">
                @forelse ($courses as $course)
                    <div class="swiper-slide image">
                        @if (!empty($course->lessons[0]->id))
                            <div>
                                <a href="{{ route('courses.watch', ['courseUrl' => $course->url, 'lesson' => $course->lessons[0]->id]) }}">
                                    <img src="{{ asset('storage/images/'.$course->image_uri) }}">
                                    <h4 class="title-slider">{{ $course->title }}</h4>
                                    <p class="course-owner">{{ $course->user->name }}</p>
                                    <p class="course-price-slider">{{ $course->price }}$</p>
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No se han encontrado cursos</p>
                @endforelse
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <!-- Slider Courses -->

        {{-- Articulos --}}
        <section class="articulos">
            <h2>Últimos Artículos</h2>
            <div class="cards">
                <a href="">
                    <x-cards>
                        <x-slot name="imageCard">meditacion.jpg</x-slot>
                        <x-slot name="alt">Imagen de una persona meditando</x-slot>
                        <x-slot name="titulo">Meditacion</x-slot>
                        <x-slot name="descripcion">Encuentra la paz interior a través de la meditación, despeja tu mente y encuentra claridad</x-slot>
                    </x-cards>
                </a>
                <a href="">
                    <x-cards>
                        <x-slot name="imageCard">corredor.jpg</x-slot>
                        <x-slot name="alt">Imagen de un chico corriendo</x-slot>
                        <x-slot name="titulo">Ejercicios</x-slot>
                        <x-slot name="descripcion">Mejora tu bienestar físico y mental con nuestra selección de ejercicios</x-slot>
                    </x-cards>
                </a>
                <a href="">
                    <x-cards>
                        <x-slot name="imageCard">hobbies.jpg</x-slot>
                        <x-slot name="alt">Imagen de un fotografo</x-slot>
                        <x-slot name="titulo">Hobbies</x-slot>
                        <x-slot name="descripcion">Descubre nuevas pasiones y despierta tu creatividad con nuestros fascinantes hobbies</x-slot>
                    </x-cards>
                </a>
            </div>
        </section> <!-- Articulos -->

        {{-- Blogs --}}
        <section class="blogs">
            <h2 class="centrar-texto mt-5">Blogs</h2>
            <article class="contenido">
                <img src="{{ Vite::asset("resources/img/descanso.jpg") }}" alt="persona durmiendo en su cama">

                <x-art-recomendacion>
                    <x-slot name="title">Duerme mejor y evita distracciones</x-slot>
                    <x-slot name="description">Descubre el camino hacia un descanso reparador con nuestra guía para dormir mejor y evitar distracciones.</x-slot>
                    <x-slot name="route">cursos</x-slot>
                </x-art-recomendacion>
            </article>

            <article class="contenido">
                <img class="imagen" src="{{ Vite::asset("resources/img/ejercicio.jpg") }}" alt="persona levantando peso muerto">

                <x-art-recomendacion>
                    <x-slot name="title">Haz ejercicio y mantente activo</x-slot>
                    <x-slot name="description">Descubre el poder transformador de la actividad física, con consejos prácticos y motivadores para incorporar el ejercicio a tu rutina diaria.</x-slot>
                    <x-slot name="route">cursos</x-slot>
                </x-art-recomendacion>
            </article>

            <article class="contenido">
                <img class="imagen" src="{{ Vite::asset("resources/img/estudio.jpg") }}" alt="cubos con la palabra study">

                <x-art-recomendacion>
                    <x-slot name="title">Estudia algo que te apacione</x-slot>
                    <x-slot name="description">Desarrolla habilidades y conocimientos mientras te sumerges en un viaje educativo personalizado, diseñado para cultivar tu amor por el tema elegido.</x-slot>
                    <x-slot name="route">cursos</x-slot>
                </x-art-recomendacion>
            </article>
        </section> <!-- Blogs -->

    </main>
@endsection