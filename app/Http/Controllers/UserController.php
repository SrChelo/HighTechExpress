<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\User;
use App\Role;

class UserController extends Controller
{

    private function verify(){
        if(!Auth::user()){
            return redirect('/');
        }
    }
    // private function verifyAd(){
    //     $this->verify();
    //     if(Auth::user()->)
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
            $query = trim($request->get('search'));
            $users = User::where('name','LIKE','%'.$query.'%')->orderBy('id','asc')->paginate();
            return view('usuarios.index',['users'=>$users,'search'=>$query]);
        }
        $users = User::paginate(15);
        return view('usuarios.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->verify();
        return view("usuarios.create",["roles"=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->verify();
        $usuario = new User();

        $usuario->name = request('name');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));

        $usuario->save();
        $usuario->asignarRol(Role::findOrFail(request('rol')));

        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->verify();
        $user = User::findOrFail($id);
        $role = $user->tieneRol()[0];
        return view('usuarios.show',['user'=>$user,'role'=>$role,'auth'=>Auth::user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->verify();
        $user = User::findOrFail($id);
        $role = new Role();
        if(isset($user->tieneRole()[0])){
            $role = $user->tieneRole()[0];
        }
        return view('usuarios.edit', ['user'=>$user,'role'=>$role, 'roles'=>Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $this->verify();
        $usuario = User::findOrFail($id);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');

        $usuario->update();
        $role = $usuario->roles;
        if(count($role)>0){
            $role_id = $role[0]->id;
            User::find($id)->roles()->updateExistingPivot($role_id, ['role_id'=>$request->get('rol') ]);
        } else {
            $usuario->asignarRol(Role::findOrFail(request('rol')));
        }

        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->verify();
        if(Auth::user()->id == $id){
            return redirect('/usuarios');
        }
        $this->verify();
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect('/usuarios');
    }
}
