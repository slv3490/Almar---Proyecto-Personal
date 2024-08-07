<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', "Almar")</title>
    @livewireStyles
    @vite(["resources/scss/app.scss", "resources/js/app.js"])
</head>
<body>
    <header class="{{ isset($inicio) ? "inicio" : "header-nav"; }}">
        <x-nav />

        <div  class="{{ isset($mostrar) ? "mostrar" : "" }} contenedor titulo-cabecera">
            <h1>Aprende a estimular tu cerebro</h1>
            <p>Mejora y crece de forma profesional y personal.</p>
        </div>
    </header>

    @yield("content")

    <footer class="footer">
        <x-redes-sociales />
    </footer>

    @livewireScripts
</body>
</html>