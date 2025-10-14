@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('header')
    Editar Categoria
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300">Nome</label>
            <input type="text" name="nome" value="{{ old('nome', $categoria->nome) }}" class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

         <div class="mb-4">
            <label for="descricao" class="block text-gray-700 dark:text-gray-300">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                rows="4"
                class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >{{ old('descricao') }}</textarea>
            @error('descricao')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Atualizar
        </button>
    </form>
</div>
@endsection
