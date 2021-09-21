@extends('layouts.base')


@section('title', 'Listing')

@section('content')

<table class="shelf">
    <tr>
        <th>Livre</th>
        <th>Auteur</th>
        <th>Genre</th>
        <th>Description</th>
        <th>Année</th>
    </tr>
    @foreach($books as $book)
        <tr class="">
            <th>{{ $book->title }}</th>
            <td>{{ $book->author->name }}</td>
            <td>
                @foreach ( $book->genres as $genre )
                    <p>{{  $genre->name  }}</p>
                @endforeach
            </td>
            <td>{{ $book->description }}</td>
            <td>{{ $book->year }}</td>

            <td>
                <form action="/delBook" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $book->id  }}"/>
                    <input type="submit" value="X">
                </form>
            </td>
            <td>
                <form action="/upBookPage" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $book->id  }}"/>
                    <input type="submit" value="Update">
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{-- @foreach ( $book->genres as $genre )
<form action="/unsetGenre" method="post">
    @csrf
    <label for="">{{  $genre->name  }}</label>
        <input type="hidden" name="book_id" value="{{ $book->id  }}"/>
        <input type="hidden" name="genre_id" value="{{ $genre->id  }}"/>
        <input type="submit" value="X">
    </form>
@endforeach --}}


@endsection


