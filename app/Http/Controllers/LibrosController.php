<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;

class LibrosController extends Controller
{
    // Obtiene todos los libros de la tabla Libro con metodo get y comprueba si se ha obtenido algun libro, si es asi se muestran y si no muestra un error 404 con mensaje de libros no encontrados.
    public function getLibros()
    {
        $libros = Libro::all();
        if(count($libros) == 0)
        {
            $response = array('error_code' => 404, 'error_msg' => ['No se ha encontrado ningun libro']);
            return response()->json($response);
        }
        else
        {
            $response = array('code' => 200, 'msg' => ['OK']);
            return $libros;
        }
        

    }

    // Obtiene los libros de la tabla Libro con metodo get donde se coincida uno de las dos propiedades ya sea genero o autor, o también si coinciden ambos. Valida si ha encontrado algun libro, si es así se muestran y si no muestra un error 404 con mensaje de libro con autor o genero no encontrado.
    public function getLibrosParam(Request $request)
    {
        
        /*$genero2 = $request->input('genero');
        $autor2 = $request->input('autor');
        return print_r($genero2.$autor2);
        die;*/
        
        $genero = $request->genero;
        $autor = $request->autor;

        if($genero != null && $autor != null)
        {
            $libros = Libro::where('genero','=',$genero)
            ->where(function ($query) use ($autor){
                $query->where('autor','=',$autor);
            })->get();
            
        }
        elseif($genero == null)
        {
            $libros = Libro::where('autor','=',$autor)->get();
        }
        elseif($autor == null)
        {
            $libros = Libro::where('genero','=',$genero)->get();
        }

        if(count($libros) == 0)
        {
            $response = array('error_code' => 404, 'error_msg' => ['Busqueda de libro con autor: '.$autor.' y genero: '.$genero.' no encontrado']);
            return response()->json($response);
        }
        else
        {
            $response = array('code' => 200, 'msg' => ['OK']);
            return $libros;
        }
        
    }

    // Añade un libro a la tabla Libro con metodo post con sus respectivas propiedades y se valida, si este contiene alguna propiedad del libro se añade un nuevo libro con esas propiedades a la tabla Libro, si por lo contrario no contiene ninguna propiedad del libro, se muestra un error 404 con mensaje no se ha podido añadir.
    public function postLibros(Request $request)
    {

        $titulo = $request->titulo;
        $sinopsis = $request->sinopsis;
        $genero = $request->genero;
        $autor = $request->autor;
        $disponible = $request->disponible;

        $libro = new Libro;
        
        $libro->titulo = $titulo;
        $libro->sinopsis = $sinopsis;
        $libro->genero = $genero;
        $libro->autor = $autor;
        $libro->disponible = $disponible;
        
        if(!empty($libro))
        {
            $libro->save();
            $response = array('code' => 200, 'msg' => ['OK']);
            return request()->all();
        }
        else
        {
            $response = array('error_code' => 404, 'error_msg' => ['Libro no se ha podido añadir']);
            return response()->json($response);
        }
        
        
    }

    // Se modifica un libro de la tabla Libro donde se encuentre el id obtenido por $request, si se obtiene alguna propiedad nueva a modificar se guardan los cambios en el libro correspondiente por id, si no se obtiene ninguna nueva propiedad a modificar, se muestra un error 404 con mensaje Libro con id: x no se ha podido modificar.
    public function putLibros(Request $request)
    {
        $titulo = $request->titulo;
        $sinopsis = $request->sinopsis;
        $genero = $request->genero;
        $autor = $request->autor;
        $disponible = $request->disponible;

        $libro = Libro::find($request->id);

        if(empty($libro))
        {
            $response = array('error_code' => 404, 'error_msg' => ['Libro con id: ' . $request->id . ' no se ha podido encontrar']);
            return response()->json($response);
        }
        else
        {
            if($titulo!=null)$libro->titulo = $titulo;
            if($sinopsis!=null)$libro->sinopsis = $sinopsis;
            if($genero!=null)$libro->genero = $genero;
            if($autor!=null)$libro->autor = $autor;
            if($disponible!=null)$libro->disponible = $disponible;
        
            if(!empty($libro))
            {
                $libro->save();
                $response = array('code' => 200, 'msg' => ['OK']);
                return request()->all();
            }
            else
            {
                $response = array('error_code' => 404, 'error_msg' => ['Libro con id: '.$request->id.' no se ha podido modificar']);
                return response()->json($response);
            }
        }
    }

    // Se borra un libro de la tabla Libro donde se encuentre la id obtenida por $request, si este libro existe se borra, por lo contrario si no existe se muestra un error 404 con mensaje Libro con id: x no se ha podido eliminar o no existe.
    public function deleteLibros(Request $request)
    {
        $libro = Libro::find($request->id);
        if(!empty($libro))
        {
            $libro->delete();
            $response = array('code' => 200, 'msg' => ['OK']);
            return request()->all();
        }
        else
        {
            $response = array('error_code' => 404, 'error_msg' => ['Libro con id: '.$request->id.'no se ha podido eliminar o no existe']);
            return response()->json($response);
        }
        
        

        
    }
}
