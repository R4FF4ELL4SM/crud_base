<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Storage;

class PessoaController extends Controller
{
    // LISTAR: busca 10 pessoas por página, em ordem alfabética
    public function index()
    {
        $pessoas = Pessoa::orderBy('nome')->paginate(10);
        return view('pessoas.index', compact('pessoas'));
    }
    // CRIAR (1/2): mostra o formulário vazio
    public function create()
    {
        return view('pessoas.create');
    }

    // CRIAR (2/2): recebe o formulário já validado e grava
    public function store(PessoaRequest $request)
    {
       $dados = $request->safe()->only(['nome']);

    // Se enviaram foto, salva em storage/app/public/fotos e guarda o caminho
    if ($request->hasFile('foto')) {
        $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }

    Pessoa::create($dados);
    return redirect()->route('pessoas.index')
        ->with('sucesso', 'Pessoa cadastrada com sucesso!');

    }

    // EDITAR (1/2): mostra o formulário preenchido ($pessoa vem da URL)
    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }
    // EDITAR (2/2): atualiza o registro
    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $dados = $request->safe()->only(['nome']);
        if ($request->hasFile('foto')) {

            // Apaga a foto antiga para não acumular arquivos órfãos
            if ($pessoa->foto) {
                Storage::disk('public')->delete($pessoa->foto);
            }
            $dados['foto'] = $request->file('foto')->store('fotos', 'public');
        }
        $pessoa->update($dados);
        return redirect()->route('pessoas.index')
            ->with('sucesso', 'Pessoa atualizada com sucesso!');
    }

    // EXCLUIR
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return redirect()->route('pessoas.index')
            ->with('sucesso', 'Pessoa excluída com sucesso!');
    }
}
