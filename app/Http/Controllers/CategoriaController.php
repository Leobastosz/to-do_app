<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('created_by', Auth::id())->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('categorias', 'public');
            $validated['imagem'] = $path;
        }

        $validated['created_by'] = Auth::id();

        Categoria::create($validated);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }


    public function show(Categoria $categoria)
    {
        $this->authorizeAcesso($categoria);
        return view('categorias.show', compact('categoria'));
    }


    public function edit(Categoria $categoria)
    {
        $this->authorizeAcesso($categoria);
        return view('categorias.edit', compact('categoria'));
    }


    public function update(Request $request, Categoria $categoria)
    {
        $this->authorizeAcesso($categoria);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            if ($categoria->imagem && Storage::disk('public')->exists($categoria->imagem)) {
                Storage::disk('public')->delete($categoria->imagem);
            }

            $path = $request->file('imagem')->store('categorias', 'public');
            $validated['imagem'] = $path;
        }

        $categoria->update($validated);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }


    public function destroy(Categoria $categoria)
    {
        $this->authorizeAcesso($categoria);

        if ($categoria->imagem && Storage::disk('public')->exists($categoria->imagem)) {
            Storage::disk('public')->delete($categoria->imagem);
        }

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }

    
    private function authorizeAcesso(Categoria $categoria)
    {
        if ($categoria->created_by !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }
}
