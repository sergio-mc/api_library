@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Filtrado de genero o autor</h1>
    <div><br>
    {{csrf_field()}}
    <form method="get" action="{{url('filtradoLibro')}}">
    <div>Genero: <input placeholder='Introduce genero' id='genero' type="text" name="genero"><br></div> 
    <br>
    <div>Autor: <input placeholder='Introduce autor'id='autor' type="text" name="autor"><br></div> 
    <br>
    <input type="submit" name='submit'>
    </form>
    </div>
</div>
@endsection