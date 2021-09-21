@extends('layouts.base')


@section('title', 'Ajout')

@section('content')
<h1>Ajout</h1>
    <form action="/addBook" method="post">
        @csrf
        <input type="text" name="title" placeholder="Titre" value="No comment">
        @foreach ( $genres as $genre )
            <input type="checkbox" name="genres[]" value="{{$genre->id}}">
            <label for="genres">{{$genre->name}}</label>
        @endforeach
        <input type="text" name="description" placeholder="description" value="Bien trache, grande fois en l'humanité">
        <input type="text" name="year" placeholder="year" value="2000">
        <select name="author_id">
            @foreach ($authors as $author)
                <option value="{{$author->id}}">{{$author->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Ajouter">
    </form>
    <a class="button" href="/addAuthor">Add Author</a>
@endsection
