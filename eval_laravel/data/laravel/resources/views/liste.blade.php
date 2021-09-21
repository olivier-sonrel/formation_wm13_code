@extends('layouts.base')


@section('title', 'Liste')

@section('content')

<table class="shelf">
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th>Sexe</th>
        <th>Description</th>
        <th>Weight</th>
        <th>Species</th>
    </tr>
    @foreach($animals as $animal)
        <tr class="">
            <th>{{ $animal->name }}</th>
            <th>{{ $animal->age }}</th>
            <th>{{ $animal->sexe }}</th>
            <td>{{ $animal->description }}</td>
            <td>{{ $animal->weight }}</td>
            <td>{{ $animal->specie->name }}</td>

            <td>
                <form action="/delAnimal" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $animal->id  }}"/>
                    <input type="submit" value="X">
                </form>
            </td>
            <td>
                <form action="/updateAnimalPage" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $animal->id  }}"/>
                    <input type="submit" value="Update">
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection


