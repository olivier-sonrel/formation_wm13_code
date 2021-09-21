@extends('layouts.base')


@section('title', 'Add specie')

@section('content')
<h1>Add specie</h1>

<table class="">
        @foreach ($species as $specie)
            <tr class="">
                <td>{{$specie->id}} = {{$specie->name}}</td>
                <td>
                    <form action="delSpecie" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $specie->id  }}"/>
                        <input type="submit" value="X">
                    </form>
                </td>
                <td>
                    <form action="updateSpeciePage" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $specie->id  }}"/>
                        <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
        @endforeach
</table>


    <form action="/addSpecie" method="post">
        @csrf
        <input type="text" name="name" placeholder="Name" value="NOM">
        <input type="submit" value="Ajouter">
    </form>
@endsection

