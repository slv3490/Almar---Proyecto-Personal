@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>

        <div>
            @foreach ($courses as $course)
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
            @endforeach
        </div>
    </div>
@endsection
