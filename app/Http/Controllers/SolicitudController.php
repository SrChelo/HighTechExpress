<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Envio;
use App\TiposEnvios;
use App\Reparto;
use DB;

class SolicitudController extends Controller
{
    public function showSome(){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->where("envios.user_id",Auth::user()->id)
                      ->get();
        return view('envios.index',['envios'=>$envios]);
    }
    public function showSomeByState($state){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->where('envios.user_id',Auth::user()->id)
                      ->where('envios.state',$state)
                      ->get();
        return view('envios.index',['envios'=>$envios]);
    }
    public function showAll(){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->get();
        return view('envios.index',['envios'=>$envios]);
    }
    public function showSomeByStateAdm($state){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->where('envios.state',$state)
                      ->get();
        return view('envios.index',['envios'=>$envios]);
    }
    public function showState($id){
        $envio = DB::table('envios')
                     ->where('id',$id)
                     ->get();
        return view('envios.show',['envio'=>$envios]);
    }
    public function denegar($id){
        $envio = Envio::findOrFail($id);
        $envio->state = "Denegado";
        $envio->update();
        return redirect(route('enviosAdd'));
    }
    public function aceptar($id){
        $envio = Envio::findOrFail($id);
        $envio->state = "En Camino";
        $envio->update();
        return redirect(route('enviosAdd'));
    }


    public function showSomeToAdd($state){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->where('envios.state','En Camino')
                      ->get();
        return view('envios.index',['envios'=>$envios]);
    }
    public function showAdded(){
        $envios = DB::table('repartos')
                      ->join('envios','envios.id','=','repartos.envio_id')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','repartos.*','tipos_envios.nombre')
                      ->where('envios.state','En Camino')
                      ->get();
        return view('envios.ruta',['envios'=>$envios]);
    }
    public function Add($id){
        $reparto = new Reparto();
        $reparto->envio_id = $id;
        $reparto->user_id = Auth::user()->id;
        $reparto->save();
        return redirect(route('ruta'));
    }
    public function end($id){
        $envio = Envio::findOrFail($id);
        $envio->state = "Terminado";
        $envio->update();
        return redirect(route('ruta'));
    }
}
