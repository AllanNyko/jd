<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
  public function index()
  {
    $modelos = Modelo::all(); 
    return view('modelos.index', compact('modelos'));
  }

  public function store(Request $request)
  {
    $modelo = new Modelo();
    $modelo->nome = $request->input('nome'); 
    $modelo->save();

    return redirect()->route('modelos.index')->with('success', 'Modelo creado exitosamente.');
  }

 
  public function update(Request $request, $id)
  {
    $modelo = Modelo::findOrFail($id);
    $modelo->nome = $request->input('nome'); 
    $modelo->save();

    return redirect()->route('modelos.index')->with('success', 'Modelo atualizado com sucesso.');
  }

  public function destroy($id)
  {
    $modelo = Modelo::findOrFail($id);
    $modelo->delete();

    return redirect()->route('modelos.index')->with('success', 'Modelo eliminado com sucesso.');
  } 

}
