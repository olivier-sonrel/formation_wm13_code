@extends('layouts.base')


@section('title', 'Update specie')

@section('content')
<h1>UPDATE</h1>
    <form action="/updateSpecie" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$specie->id}}">
        <input type="text" name="name" value="{{$specie->name}}">
        <input type="submit" value="Update">

    </form>
@endsection