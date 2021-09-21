@extends('layouts.base')


@section('title', 'Ajout')

@section('content')
<h1>UPDATE</h1>
    <form action="/upAuthor" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$author->id}}">
        <input type="text" name="name" value="{{$author->name}}">
        <input type="submit" value="Update">

    </form>
@endsection