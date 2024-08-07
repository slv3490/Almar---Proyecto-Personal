<div>
    <div class="campo">
        <label for="title">Título Lección</label>
        <input type="text" id="title" placeholder="Ej: Abogados" name="title" value="{{ (!$lesson) ? old('title') : $lesson->title }}">
    </div>
    @error('title') <p class="error">{{ $message }}</p> @enderror
    
    <div class="campo">
        <label for="description">Descripción</label>
        <input type="text" id="description" placeholder="Ej: Abogados" name="description" value="{{ (!$lesson) ? old('title') : $lesson->description }}">
    </div>
    @error('description') <p class="error">{{ $message }}</p> @enderror
    
    <div class="campo">
        <label for="content_uri">Contenido</label>
        <input type="text" id="content_uri" placeholder="Url de la clase subida a youtube" name="content_uri" value="{{ (!$lesson) ? old('title') : $lesson->content_uri }}">
    </div>
    @error('content_uri') <p class="error">{{ $message }}</p> @enderror

</div>