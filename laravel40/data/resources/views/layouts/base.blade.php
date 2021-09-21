<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/style.css")}}">    {{-- <link rel="stylesheet" href="css/style.css"> --}}


</head>
<body>
    <header>
        <ul class="flex header-menu">
            <li><a href="/">Accueil</a></li>
            <li><a href="/listing">Listing</a></li>
            <li><a href="/addBook">Ajout Book</a></li>
            <li><a href="/addAuthor">Auteur</a></li>
            <li><a href="/addGenre">Genre</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </header>
    <main>
        @yield('content')
    </main>
    <footer></footer>
</body>
</html>
