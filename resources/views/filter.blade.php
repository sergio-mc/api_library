
<div class="container">
    <div class="row justify-content-center">
    <h1>Filtrado de genero o autor</h1>
    {{csrf_field()}}
    <form method="post" action="LibrosController@getLibrosParam">
    Genero: <input id='genero' type="text" name="genero"><br>
    <br>
    Autor: <input id='autor' type="text" name="autor"><br>
    <br>
    <input type="submit" name='submit'>
    </form>
    </div>
</div>

