@extends('layouts.base')


@section('title', 'update animal')

@section('content')
<h1>UPDATE</h1>
    <form action="/updateAnimal" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $animal->id  }}">
        <input type="text" name="name" placeholder="name" value="{{ $animal->name }}">
        <input type="text" name="age" placeholder="age" value="{{ $animal->age }}">
        <input type="text" name="description" placeholder="description" value="{{ $animal->description }}">
        <input type="text" name="sexe" placeholder="sexe" value="{{ $animal->sexe }}">
        <input type="text" name="weight" placeholder="weight" value="{{ $animal->weight }}">
        <select name="specie_id">
            @foreach ($species as $specie)
             <option value="{{$specie->id}}"{{$animal->specie_id == $specie->id ?'selected' : ''}} selected>{{$specie->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="Update">
        <a class="button" href="/addSpecie">Add Specie</a>
    </form>
@endsection

