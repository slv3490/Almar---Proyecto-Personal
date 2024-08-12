@extends("layouts.base")

@section('content')
    <div class="contenedor dashboard">
        <x-dashboard-component :title="$title"/>
    </div>
@endsection

<script>
    const apiToken = "{{ session('api_token') }}";

    localStorage.setItem('token', apiToken);
</script>