@extends('layouts.base')


@section('title', 'Ajout')

@section('content')
<h1>UPDATE</h1>
    <form action="/upBook" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $book->id  }}">
        <input type="text" name="title" placeholder="Titre" value="{{ $book->title }}">
        @foreach ( $genres as $genre )
            {{-- @if ($book->genres[$genre->id]) --}}
                <input type="checkbox" name="genres[]" value="{{$genre->id}}" checked>
                <label for="genres">{{$genre->name}}</label> 
            {{-- @else
                <input type="checkbox" name="genres[]" value="{{$genre->id}}">
                <label for="genres">{{$genre->name}}</label>
            @endif --}}
        @endforeach
        <input type="text" name="description" placeholder="description" value="{{ $book->description }}">
        <input type="text" name="year" placeholder="year" value="{{ $book->year }}">
        <select name="author_id">
            @foreach ($authors as $author)
             <option value="{{$author->id}}"{{$book->author_id == $author->id ?'selected' : ''}} selected>{{$author->name}}</option>
                 {{-- @if ($book->author_id == $author->id)
                    <option value="{{$author->id}}" selected>{{$author->name}}</option>
                @else
                    <option value="{{$author->id}}" >{{$author->name}}</option>
                @endif --}}
            @endforeach
        </select>
        <input type="submit" value="Update">
        <a class="button" href="/addAuthor">Add Author</a>
    </form>
@endsection

