@extends('layouts.base')


@section('title', 'Ajout')

@section('content')
<h1>Ajout genre</h1>

<table class="">
        @foreach ($genres as $genre)
            <tr class="">
                <td>{{$genre->id}} = {{$genre->name}}</td>
                <td>
                    <form action="putBookInGenre" method="post">
                        @csrf
                        <select name="book_id">
                            @foreach ($books as $book)
                                <option value="{{$book->id}}">{{$book->title}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="genre_id" value="{{ $genre->id  }}"/>
                        <input type="submit" value="Ajouter">
                    </form>
                </td>           
            </tr>
            @endforeach
        @endsection
                                                                                                    {{-- <td>
                                                                                                        <form action="delGenre" method="post">
                                                                                                            @csrf
                                                                                                            <input type="hidden" name="id" value="{{ $genre->id  }}"/> 
                                                                                                            <input type="submit" value="X">
                                                                                                        </form>
                                                                                                    </td>
                                                                                                    <td>
                                                                                                        <form action="upGenrePage" method="post">
                                                                                                            @csrf
                                                                                                            <input type="hidden" name="id" value="{{ $genre->id  }}"/> 
                                                                                                            <input type="submit" value="Update">
                                                                                                        </form>
                                                                                                    </td>       --}}