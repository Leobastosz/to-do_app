<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TarefaController extends Controller
{
    /**
     * Exibe a lista de tarefas
     */
    public function index()
    {
        $tarefas = Tarefa::latest()->get();
        return view('tarefa.index', compact('tarefas'));
    }

    /**
     * Mostra o formulário de criação
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Armazena uma nova tarefa
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'arquivo' => 'nullable|file|max:20480', // até 20MB
        ]);

        $tarefa = new Tarefa();
        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'] ?? null;

        // Upload do arquivo (opcional)
        if ($request->hasFile('arquivo')) {
            $path = $request->file('arquivo')->store('categorias', 'public');
            $tarefa->arquivo = $path;
        }

        $tarefa->save();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Exibe uma tarefa específica
     */
    public function show($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefa.show', compact('tarefa'));
    }

    /**
     * Mostra o formulário de edição
     */
    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('tarefa.edit', compact('tarefa'));
    }

    /**
     * Atualiza a tarefa
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'arquivo' => 'nullable|file|max:20480',
        ]);

        $tarefa = Tarefa::findOrFail($id);
        $tarefa->titulo = $validated['titulo'];
        $tarefa->descricao = $validated['descricao'] ?? null;

        // Atualiza o arquivo se enviado
        if ($request->hasFile('arquivo')) {
            if ($tarefa->arquivo && Storage::disk('public')->exists($tarefa->arquivo)) {
                Storage::disk('public')->delete($tarefa->arquivo);
            }

            $path = $request->file('arquivo')->store('categorias', 'public');
            $tarefa->arquivo = $path;
        }

        $tarefa->save();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Exclui a tarefa
     */
    public function destroy($id)
    {
        $tarefa = Tarefa::findOrFail($id);

        if ($tarefa->arquivo && Storage::disk('public')->exists($tarefa->arquivo)) {
            Storage::disk('public')->delete($tarefa->arquivo);
        }

        $tarefa->delete();

        return redirect()
            ->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso!');
    }
}
