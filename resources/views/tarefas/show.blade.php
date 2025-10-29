@extends('layouts.main')

@section('title', 'Detalhes da Tarefa')
@section('header', 'Detalhes da Tarefa')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Título</h3>
        <p class="text-gray-700 dark:text-gray-200">{{ $tarefa->titulo }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Categoria</h3>
        <p class="text-gray-700 dark:text-gray-200">{{ $tarefa->categoria->nome ?? '-' }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Data Limite</h3>
        <p class="text-gray-700 dark:text-gray-200">{{ $tarefa->data_limite ? \Carbon\Carbon::parse($tarefa->data_limite)->format('d/m/Y') : '-' }}</p>
    </div>

    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Concluída</h3>
        @if($tarefa->concluida)
            <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Sim</span>
        @else
            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-xs">Não</span>
        @endif
    </div>

    <div class="flex justify-end">
        <a href="{{ route('tarefas.index') }}" 
           class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded hover:bg-gray-400 dark:hover:bg-gray-500">
           Voltar
        </a>
        <a href="{{ route('tarefas.edit', $tarefa) }}" 
           class="ml-2 px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded">
           Editar
        </a>
    </div>
</div>
@endsection
