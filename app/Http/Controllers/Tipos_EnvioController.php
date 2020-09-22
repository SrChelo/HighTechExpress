<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TiposEnvios;

class Tipos_EnvioController extends Controller
{
    public function todas(){
        return view('envios.tipos',['tipos'=>TiposEnvios::all()]);
    }
}
