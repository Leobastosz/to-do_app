<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    
    public function index()
    {
        $tarefas = Tarefa::where('created_by', Auth::id())
                         ->with('categoria')
                         ->latest()
                         ->get();

        return view('tarefas.index', compact('tarefas'));
    }

  

    public function create()
    {
        $categorias = Categoria::where('created_by', Auth::id())->get();
        return view('tarefas.create', compact('categorias'));
    }

   

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_limite' => 'nullable|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Tarefa::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data_limite' => $request->data_limite,
            'categoria_id' => $request->categoria_id,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    

    public function show(Tarefa $tarefa)
    {
        $this->authorizeAcesso($tarefa);
        return view('tarefas.show', compact('tarefa'));
    }

    

    public function edit(Tarefa $tarefa)
    {
        $this->authorizeAcesso($tarefa);
        $categorias = Categoria::where('created_by', Auth::id())->get();
        return view('tarefas.edit', compact('tarefa', 'categorias'));
    }

  

    public function update(Request $request, Tarefa $tarefa)
    {
        $this->authorizeAcesso($tarefa);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_limite' => 'nullable|date',
            'categoria_id' => 'required|exists:categorias,id',
            'concluida' => 'nullable|boolean',
        ]);

        $tarefa->update($request->only(['titulo', 'descricao', 'data_limite', 'categoria_id', 'concluida']));

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

 

    public function destroy(Tarefa $tarefa)
    {
        $this->authorizeAcesso($tarefa);
        $tarefa->delete();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa excluída com sucesso!');
    }



    public function toggleStatus(Tarefa $tarefa)
    {
        $this->authorizeAcesso($tarefa);
        $tarefa->update(['concluida' => !$tarefa->concluida]);

        return redirect()->route('tarefas.index')->with('success', 'Status da tarefa atualizado!');
    }

    
    
    private function authorizeAcesso(Tarefa $tarefa)
    {
        if ($tarefa->created_by !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }
    }
}
