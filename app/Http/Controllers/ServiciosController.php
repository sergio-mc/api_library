<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\User;
use App\Libro_User;


class ServiciosController extends Controller
{

    // Se añade un prestamo en la Tabla Libro_User intermediaria con un metodo post, si el libro existe y esta disponible se presta 'se añade a la tabla', si por lo contrario no existe o no está disponible se muestra un error 404 con mensaje Libro con id: x no se ha podido prestar
    public function prestar(Request $request)
    {
        $libro = Libro::find($request->libro_id);
        $user = User::find($request->user_id);

        if(!empty($libro) && !empty($user) && $libro->disponible != 0)
        {
            $libro->disponible = 0;
            $prestamo = new Libro_User;
            $prestamo->libro_id = $request->libro_id;
            $prestamo->user_id = $request->user_id;
            $prestamo->fecha_prestamo = date("Y-m-d H:i:s");
            $prestamo->save();
            $libro->save();
            $response = array('code' => 200, 'msg' => ['OK']);
            return request()->all();
            return response()->json($response);
        }
        else
        {
            $response = array('error_code' => 404, 'error_msg' => 'Libro con id: '.$request->libro_id.' no se ha podido prestar');
            return response()->json($response);
        }
    }

    // Se crea una devolucion modificando el prestamo de la tabla Libro_User, se busca el prestamo por Libro_Id y Usuario_Id, si este existe y no esta disponible en la tabla Libro, significa que se puede devolver, se devuelve modificando el boolean disponible del libro a 1. Si en caso contrario no existe el prestamo o esta disponible significa que no se ha prestado por lo cual no se puede devolver.
    public function devolver(Request $request)
    {
        $libro_id = $request->libro_id;
        $user_id = $request->user_id;
        $libro_user = Libro_User::where('libro_id','=',$libro_id)
            ->where(function ($query) use ($user_id){
                $query->where('user_id','=',$user_id);
            })->first();
        
        if(!empty($libro_user) && $libro_user->libro->disponible === 0)
        {
            $libro = Libro::find($libro_id);
            $libro->disponible = 1;
            $libro->save();
            
            
            $libro_user->fecha_devolucion = date("Y-m-d H:i:s");
            $libro_user->save();
            $response = array('code' => 200, 'msg' => ['OK']);
            return request()->all();
            return response()->json($response);
        }
        else
        {
            $response = array('error_code' => 404, 'error_msg' => 'Devolución con libro_id: '.$libro_id.' y usuario: '.$user_id.' no se ha podido devolver');
            return response()->json($response);
        }
    }

    // Se obtienen todos los prestamos/devoluciones por id del usuario logeado
    public function getAll($id)
    {
        $user = User::find($id);

        if(empty($user))
        {
            $response = array('error_code' => 404, 'error_msg' => 'No existe usuario logeado');
            return response()->json($response);
        }
        else
        {
            $prestamosDevoluciones = Libro_User::where('user_id','=',$id)->get();
            return view('prestamosDevoluciones',['prestamosDevoluciones' => $prestamosDevoluciones]);
        }

        
    }
}
