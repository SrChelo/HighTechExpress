<?php

namespace App\Http\Controllers;
use App\User;
use App\Envio;
use App\Role;
use App\TiposEnvios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

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
            $admin->avatar = "admin.png";
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
    private function verifyAd($id){
        $role = Role::findOrFail(User::findOrFail(Auth::user()->id)->tieneRole()[0]->id);
        $reg = "/$id/i";
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
        if($this->verifyAd(1)){
            return view('home',['user'=>Auth::user(),'rol'=>"si"]);
        }
        if($this->verifyAd(2)){
            $cEnvios = count(Envio::all());
            $cUsuarios = count(User::all());
            $envios = [];
            $users = [];
            for($i=1;$i<=12;$i++){
                $envios[$i-1]=count(DB::table('envios')->whereMonth('created_at', $i)->get());
                $users[$i-1]=count(DB::table('users')->whereMonth('created_at', $i)->get());
            }
            return view('home',['user'=>Auth::user(),'cEnvios'=>$cEnvios,'cUsuarios'=>$cUsuarios,'envios'=>$envios,'users'=>$users]);
        }
        if($this->verifyAd(3)){
            $add = DB::table('repartos')
                      ->join('envios','envios.id','=','repartos.envio_id')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','repartos.*','tipos_envios.nombre')
                      ->where('envios.state','En Camino')
                      ->where('repartos.user_id',Auth::user()->id)
                      ->limit(2)
                      ->get();
            $data = DB::table('repartos')->select('envio_id')->get();
            $arr = [];
            for($i=0;$i<count($data);$i++){
                $arr[$i]=$data[$i]->envio_id;
            }
            $espera = DB::table('envios')
                        ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                        ->select('envios.*','tipos_envios.nombre')
                        ->whereNotIn('envios.id',$arr)
                        ->where('envios.state','En Camino')
                        ->get();
            return view('home',['user'=>Auth::user(),'ruta'=>$add,'espera'=>$espera]);
        }
    }
}
