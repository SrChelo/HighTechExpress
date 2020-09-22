<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Envio;
use App\TiposEnvios;
use DB;

class SolicitudController extends Controller
{
    public function showSome(){
        $envios = DB::table('envios')
                      ->join('tipos_envios','envios.tipo_id','=','tipos_envios.id')
                      ->select('envios.*','tipos_envios.nombre')
                      ->where('envios.user_id',Auth::user()->id)
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
}
