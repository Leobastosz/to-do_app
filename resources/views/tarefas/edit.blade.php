@extends('layouts.main')

@section('title', 'Editar Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Editar Tarefa</h2>

    <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título</label>
            <input type="text" name="titulo" value="{{ $tarefa->titulo }}" required
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descrição</label>
            <textarea name="descricao" rows="4"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $tarefa->descricao }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Substituir Arquivo</label>
            <input type="file" name="arquivo"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" />
            @if ($tarefa->arquivo)
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Arquivo atual:
                    <a href="{{ Storage::url($tarefa->arquivo) }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ basename($tarefa->arquivo) }}
                    </a>
                </p>
            @endif
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('tarefas.index') }}" class="px-4 py-2 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Atualizar</button>
        </div>
    </form>
</div>
@endsection
