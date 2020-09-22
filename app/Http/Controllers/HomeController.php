<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\TiposEnvios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(count(Role::all()) == 0){
            $roles = ["Cliente","Administrador","Repartidor"];
            for($i = 0;$i < 3;$i++){
                $role = new Role();
                $role->name = $roles[$i];
                $role->save();
            }
        }
        if(count(User::all()) == 0){
            $admin = new User();
            $admin->name = "Admin";
            $admin->email = "admin@admin.com";
            $admin->password = bcrypt("admin");
            $admin->save();
            $admin->asignarRol(Role::findOrFail(2));
        }
        if(count(TiposEnvios::all()) == 0){
            $tipos = ["Ligero","Express Ligero","Medio","Pesado","Extra Pesado"];
            $minweight = [0,0,10,100,1000];
            $maxweight = [10,10,100,1000,20000];
            $mindim = [0,0,0.5,5,100];
            $maxdim = [0.5,0.5,5,100,200];
            for($i = 0;$i < 5; $i++){
                $tipo = new TiposEnvios();
                $tipo->nombre = $tipos[$i];
                $tipo->minweight = $minweight[$i];
                $tipo->maxweight = $maxweight[$i];
                $tipo->mindim = $mindim[$i];
                $tipo->maxdim = $maxdim[$i];
                $tipo->save();
            }
        }
        $this->middleware('auth');
    }
    private function verify(){
        if(!Auth::user()){
            return false;
        }
        return true;
    }
    private function verifyAd(){
        if($this->verify()){
            return false;
        }
        $role = Role::findOrFail(User::findOrFail(Auth::user()->id)->tieneRole()[0]->id);
        $reg = "/2/i";
        if(!preg_match($reg,$role->id)){
            return false;
        }
        return true;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',['user'=>Auth::user()]);
    }
}
