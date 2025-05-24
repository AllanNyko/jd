<?php

namespace App\Http\Controllers;
use App\Models\Marca;

use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index(){
       
        return view('modelos.index');
    }

  public function create(){
    $marcas = Marca::all();
    return view('modelos.create', compact('marcas'));
}

}
