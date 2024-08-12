@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <section>
            @if (Auth::user()->hasPermissionTo("create categories"))
                <a href="{{ route('create-categories') }}" class="boton">Crear Categoria</a>
            @endif
            
            @if (Auth::user()->hasAllPermissions(["update categories", "delete categories"]))
                <ul class="categories-list"></ul>
            @endif
        </section>
    </div>
@endsection