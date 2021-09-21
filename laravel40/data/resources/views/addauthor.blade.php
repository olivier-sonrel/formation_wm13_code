@extends('layouts.base')


@section('title', 'Ajout')

@section('content')
<h1>Ajout auteur</h1>

<table class="">
        @foreach ($authors as $author)
            <tr class="">
                <td>{{$author->id}} = {{$author->name}}</td>
                <td>
                    <form action="delAuthor" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $author->id  }}"/> {{--a check--}}
                        <input type="submit" value="X">
                    </form>
                </td>
                <td>
                    <form action="upAuthorPage" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $author->id  }}"/> {{--a check--}}
                        <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
        @endforeach
</table>


    <form action="/addAuthor" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" value="NOM">
        <input type="submit" value="Ajouter">
    </form>
@endsection

