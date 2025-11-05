@extends('layouts.app')

@section('title', 'Nova Categoria')

@section('header')
    Cadastrar Nova Categoria
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 dark:text-gray-300">Nome</label>
            <input
                type="text"
                name="nome"
                id="nome"
                value="{{ old('nome') }}"
                class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required
            >
            @error('nome')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
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

            <div class="mb-4">
                <label for="imagem" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Imagem</label>
                <input type="file" name="imagem" id="imagem" accept="image/*"
                class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
            </div>




        <div class="flex items-center justify-end space-x-2">
            <a href="{{ route('categorias.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection
