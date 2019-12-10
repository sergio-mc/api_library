<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{

    // Obtiene todos los usuarios de la tabla User con metodo get y comprueba si se ha obtenido algun usuario, si es asi se muestran y si no muestra un error 404 con mensaje no se ha encontrado ningun usuario.
    public function getUsuarios(Request $request)
    {
        $usuario = User::all();
        if(count($usuario) == 0)
        {
            $response = array('error_code' => 404, 'error_msg' => ['No se ha encontrado ningun usuario']);
            return response()->json($response);
        }
        else
        {
            $response = array('code' => 200, 'msg' => ['OK']);
            return $usuario;
        }
        
    }


    
    // Añade un usuario a la tabla User con metodo post con sus respectivas propiedades y se valida, si se añaden todos los campos obligatorios para crear un usuario, se añade este a la tabla User, si por lo contrario un campo obligatorio no existe, no se crea y se muestra un error 404 con mensaje Usuario no se ha podido crear, completa todos los campos.
    public function postUsuarios(Request $request)
    {
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->api_token = hash('sha256', $request->api_token);

        if(!empty($usuario->name) && !empty($usuario->email) && !empty($usuario->password) && !empty($usuario->api_token))
        {   
            $usuario->save();
            return request()->all();
            
        }else
        {
            $response = array('error_code' => 404, 'error_msg' => ['Usuario no se ha podido crear, completa todos los campos']);
            return response()->json($response);
        }
    }


    // Se modifica un usuario de la tabla User donde se encuentre el id obtenido por $request, si se obtiene alguna propiedad nueva a modificar se guardan los cambios en el usuario correspondiente por id, si no se obtiene ninguna nueva propiedad a modificar, se muestra un error 404 con mensaje Usuario con id: x no se ha podido modificar.
    public function putUsuarios(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        $usuario = User::find($request->id);

        if(empty($usuario))
        {
            $response = array('error_code' => 404, 'error_msg' => ['Usuario con id: ' . $request->id . ' no se ha podido encontrar']);
            return response()->json($response);
        }
        else{
            if($name!=null)$usuario->name = $name;
            if($email!=null)$usuario->email = $email;
            if($password!=null)$usuario->password = $password;
            
            if(!empty($usuario))
            {
                $usuario->save();
                return request()->all();
            }
            else
            {
                $response = array('error_code' => 404, 'error_msg' => ['Usuario con id: ' . $request->id . ' no se ha podido modificar']);
                return response()->json($response);
            }
        }
        
    }


    // Se borra un usuario de la tabla User donde se encuentre la id obtenida por $request, si este usuario existe se borra, por lo contrario si no existe se muestra un error 404 con mensaje Usuario con id: x no se ha podido eliminar o no existe.
    public function deleteUsuarios(Request $request)
    {
        $usuario = User::find($request->id);
        

        if(!empty($usuario))
        {
            $usuario->delete();
            return request()->all();
        }
        else
        {
            $response = array('error_code' => 404, 'error_msg' => ['Usuario con id: ' . $request->id . ' no se ha podido eliminar o no existe']);
            return response()->json($response);
        }
        
    }
}
