<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Home;
use App\Image;
use DB;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $role = $user->tieneRol()[0];
        return view('usuarios.profile',['user'=>$user,'role'=>$role]);
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        if($user){
            if(count(User::where('email','=', request('email'))->where('id','<>',$id)->get())){
                return back()->with('error','Correo ingresado ya registrado');
            }
            if(request('name')){
                $pattern = "/^[\S ]{8,50}$/i";
                if(!preg_match($pattern, request('name'))){
                    return back()->with('error','Debe ingresar un nombre válido, entre 8 y 50 caracteres');
                }
            }
            if(request('newPass')){
                $pattern = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/i";
                if(!preg_match($pattern, request('newPass'))){
                    return back()->with('error','La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.');
                }
                if(request('RnewPass')){
                    $pattern = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/i";
                    if(!preg_match($pattern, request('newPass'))){
                        return back()->with('error','La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula.');
                    }
                }else {
                    return back()->with('error','Debe confirmar la contraseña');
                }
            }
            
            if(request('email')){
                $pattern = "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/i";
                if(!preg_match($pattern, request('email'))){
                    return back()->with('error','Email ingresado no válido');
                }
            }else{
                return back()->with('error','Debe Ingresar un correo');
            }

            if(Hash::check(request('password'), $user->password)){
                $user->name = request('name');
                $user->email = request('email');
    
                if(request('newPass')){
                    if(request('newPass') == request('RnewPass')){
                        $user->password = bcrypt(request('newPass'));
                    } else {
                        return back()->with('error','Error en las nuevas contraseñas');
                    }
                }
                if(request('imag')){
                    $image = request('imag');  // your base64 encoded
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = time().'.'.'png';
                    \File::put(storage_path(). '/app/public/images/' . $imageName, base64_decode($image));
                    if($user->avatar != 'admin.png' && $user->avatar != 'default.png'){
                        Storage::disk('public')->delete('images/'.$user->avatar);
                    }
                    $user->avatar = $imageName;
                }
                $user->update();
                return back()->with('success','Datos Actualizados');
            } else {
                return back()->with('error','Contraseña no coincide');
            }
        } else {
            return back()->with('error','Ha ocurrido un error, intentelo nuevamente');
        }
    }
}
