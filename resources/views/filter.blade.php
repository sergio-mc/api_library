@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Filtrado de genero o autor</h1>
    <div class="row justify-content-center">
    {{csrf_field()}}
    <form method="get" action="{{url('filtradoLibro')}}">
    Genero: <input id='genero' type="text" name="genero"><br>
    <br>
    Autor: <input id='autor' type="text" name="autor"><br>
    <br>
    <input type="submit" name='submit'>
    </form>
    </div>
</div>
@endsection