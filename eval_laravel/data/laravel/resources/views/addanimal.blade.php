@extends('layouts.base')


@section('title', 'Add animal')

@section('content')
<h1>Ajout</h1>
    <form action="/addAnimal" method="post">
        @csrf

        <div class="label">
            <label for="name">name</label>
            <input type="text" name="name" placeholder="name" value="un autre">
        </div>
        <div class="label">
            <label for="age">age</label>
            <input type="text" name="age" placeholder="age" value="8">
        </div>
        <div class="label">
            <label for="description">description</label>
            <input type="text" name="description" placeholder="description" value="wdhfdfdfwdfg">

        </div>
        <div class="label">
            <label for="sexe">sexe</label>
            <input type="text" name="sexe" placeholder="sexe" value="trans">

        </div>
        <div class="label">
            <label for="weight">weight</label>
            <input type="text" name="weight" placeholder="weight" value="200">

        </div>
        <div class="label">
            <label for="specie_id">Species</label>
            <select name="specie_id">
                @foreach ($species as $specie)
                    <option value="{{$specie->id}}">{{$specie->name}}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" value="Ajouter">
    </form>
    <a class="button" href="/addSpecie">Add Specie</a>
@endsection
