<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Envio;
use App\TiposEnvios;


class EnvioController extends Controller
{
    
    public function index()
    {
        
    }

    public function create()
    {
        return view('envios.tipos',['tipos'=>TiposEnvios::all()]);
    }

    public function store(Request $request)
    {
        $envio = new Envio();
        $envio->user_id = Auth::user()->id;
        $envio->tipo_id = request('tipo');
        $envio->weight = request('weight');
        $envio->dimen = request('dim');
        $envio->place_a = request('placeA');
        $envio->place_b = request('placeB');
        $envio->description = request('desc');
        $envio->state = "En Espera";
        $envio->save();
        return redirect('/');
    }

    public function show($id)
    {
        return view('envios.create',['tipo'=>TiposEnvios::findOrFail($id)]);
    }

    public function edit($id)
    {

    }

    public function update(UserFormRequest $request, $id)
    {

    }

    public function destroy($id)
    {
        
    }
}
