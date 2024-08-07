@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>

        <section>
            <a href="{{ route('categories.index') }}" class="boton">Volver</a>
            <div class="container-divs">
                <div class="div-left">
                    <h4>Crear Categorías</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis laudantium aspernatur tempora repellat dolor sint, minus, magnam.</p>
                </div>
                <div class="div-right">
                    <form method="POST" action="{{ route('store-categories') }}" class="formulario">
                        @csrf
                        <div class="campo">
                            <label for="name">Nombre Categoria</label>
                            <input type="text" id="name" placeholder="Ej: Abogados" name="name">
                        </div>
                        @error('name') <p class="error">{{ $message }}</p> @enderror
                        
                        <input type="{{ Auth::user()->hasPermissionTo('spectator') ? 'button' : 'submit' }}" value="Crear Categoría" class="boton {{ Auth::user()->hasPermissionTo('spectator') ? 'disabled' : '' }}">
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection