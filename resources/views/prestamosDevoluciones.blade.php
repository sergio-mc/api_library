@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Prestamos y Devoluciones</h1>
    <div>
    @if(isset($prestamosDevoluciones))
    @foreach($prestamosDevoluciones as $prestamoDevolucion)
    <div>ID: <?=  $prestamoDevolucion->id ?></div>

    <div>Titulo: <?=  $prestamoDevolucion->libro->titulo ?></div>
    <div>Sinopsis: <?=  $prestamoDevolucion->libro->sinopsis ?></div>
    <div>Genero: <?=  $prestamoDevolucion->libro->genero ?></div>
    <div>Autor: <?=  $prestamoDevolucion->libro->autor ?></div>

    <div>Libro_ID: <?=  $prestamoDevolucion->libro_id ?></div>
    
    <div>User_ID: <?=  $prestamoDevolucion->user_id ?></div>

    <div>Fecha prestamo: <?=  $prestamoDevolucion->fecha_prestamo ?></div>
    
    <div>Fecha devolucion: <?=  $prestamoDevolucion->fecha_devolucion?></div>
    @endforeach
    <div>
    </div>
    
    @endif
    </div>
</div>
@endsection

