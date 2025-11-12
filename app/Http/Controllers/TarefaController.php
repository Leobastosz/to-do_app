<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
   
    public function index()
    {
        $tarefas = Tarefa::where('created_by', Auth::id())->latest()->get();
        return view('tarefas.index', compact('tarefas'));
    }

    public function create()
    {
         $categorias = \App\Models\Categoria::where('created_by', auth()->id())->get();
        return view('tarefas.create', compact('categorias'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'data_limite' => 'nullable|date',
            'concluida' => 'nullable|boolean',
            'arquivo' => 'nullable|file|max:20480',
        ]);

        $tarefa = new Tarefa();
        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'] ?? null;
        $tarefa->categoria_id = $validated['categoria_id'];
        $tarefa->data_limite = $validated['data_limite'] ?? null;
        $tarefa->concluida = $validated['concluida'] ?? false;
        $tarefa->created_by = Auth::id();

       
        if ($request->hasFile('arquivo')) {
            $path = $request->file('arquivo')->store('tarefas', 'public');
            $tarefa->arquivo = $path;
        }

        $tarefa->save();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    
   
    public function show($id)
    {
        $tarefa = Tarefa::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        return view('tarefas.show', compact('tarefa'));
    }


   
    public function edit($id)
    {
        $tarefa = Tarefa::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        return view('tarefas.edit', compact('tarefa'));
    }

    

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'data_limite' => 'nullable|date',
            'concluida' => 'nullable|boolean',
            'arquivo' => 'nullable|file|max:20480',
        ]);

        $tarefa = Tarefa::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'] ?? null;
        $tarefa->categoria_id = $validated['categoria_id'];
        $tarefa->data_limite = $validated['data_limite'] ?? null;
        $tarefa->concluida = $validated['concluida'] ?? false;

        
        if ($request->hasFile('arquivo')) {
            if ($tarefa->arquivo && Storage::disk('public')->exists($tarefa->arquivo)) {
                Storage::disk('public')->delete($tarefa->arquivo);
            }

            $path = $request->file('arquivo')->store('tarefas', 'public');
            $tarefa->arquivo = $path;
        }

        $tarefa->save();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

   
    public function destroy($id)
    {
        $tarefa = Tarefa::where('id', $id)
            ->where('created_by', Auth::id())
            ->firstOrFail();

        if ($tarefa->arquivo && Storage::disk('public')->exists($tarefa->arquivo)) {
            Storage::disk('public')->delete($tarefa->arquivo);
        }

        $tarefa->delete();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso!');
    }
}
