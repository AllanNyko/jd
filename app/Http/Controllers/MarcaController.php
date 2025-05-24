<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }
    
    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        // 1) Regras no primeiro parâmetro
        // 2) Mensagens no segundo parâmetro
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:25',
                'unique:marcas,nome',
                // 'not_regex:/\d/',            // não pode conter nenhum dígito
            ],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string'   => 'O campo nome deve ser uma string.',
            'nome.max'      => 'O campo nome não pode ter mais de 25 caracteres.',
            'nome.unique'   => 'Já existe uma marca com esse nome.',
            // 'nome.not_regex' => 'O campo nome não pode conter números.',
        ]);

        $marca = new Marca($validated);

        try {
            if ($marca->save()) {
                return redirect()->route('marcas.index')
                    ->with('success', 'Marca criada com sucesso!');
            }

            return redirect()->back()
                ->with('error', 'Não foi possível salvar a marca.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()
                ->with('error', 'Falha ao criar a marca: ' . $e->getMessage());
        }
    }
 

    public function show($id)
    {
        // Lógica para exibir uma marca específica
    }
    public function edit($id) {
        //Não foi criado uma pagina de edição
    }

    
    public function update(Request $request, $id)
    {
        // 1) Validação
        $validated = $request->validate([
            'nome' => [
                'required',
                'max:10',
                'unique:marcas,nome,' . $id,
            ],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max'      => 'O nome não pode ter mais de 10 caracteres.',
            'nome.unique'   => 'Já existe uma marca com esse nome.',
        ]);

        try {
            // 2) Busca o modelo e atualiza
            $marca = Marca::findOrFail($id);
            $marca->nome = $validated['nome'];
            $marca->save();
            
            return redirect()
                ->route('marcas.index')
                ->with('success', 'Marca atualizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao atualizar a marca: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $marca = Marca::findOrFail($id);
            $marca->delete();

            return redirect()
                ->route('marcas.index')
                ->with('success', 'Marca excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erro ao excluir a marca: ' . $e->getMessage());
        }
    }
}
