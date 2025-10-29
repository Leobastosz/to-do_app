@extends('layouts.main')

@section('title', 'Nova Tarefa')
@section('header', 'Cadastrar Nova Tarefa')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <form action="{{ route('tarefas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="titulo" class="block text-gray-700 dark:text-gray-200 font-medium">Título</label>
            <input type="text" name="titulo" id="titulo" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                   value="{{ old('titulo') }}">
            @error('titulo')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="block text-gray-700 dark:text-gray-200 font-medium">Categoria</label>
            <select name="categoria_id" id="categoria_id" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                <option value="">Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="data_limite" class="block text-gray-700 dark:text-gray-200 font-medium">Data Limite</label>
            <input type="date" name="data_limite" id="data_limite"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                   value="{{ old('data_limite') }}">
            @error('data_limite')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="concluida" id="concluida" value="1" {{ old('concluida') ? 'checked' : '' }} 
                   class="mr-2">
            <label for="concluida" class="text-gray-700 dark:text-gray-200 font-medium">Concluída</label>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('tarefas.index') }}" 
               class="mr-2 px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
               Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection
