@extends('layouts.main')

@section('title', 'Detalhes da Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ $tarefa->titulo }}</h2>

    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $tarefa->descricao }}</p>

    @if ($tarefa->arquivo)
        <div class="mt-4">
            <p class="text-gray-700 dark:text-gray-300 mb-2">Arquivo:</p>
            <a href="{{ Storage::url($tarefa->arquivo) }}" target="_blank"
                class="inline-block text-blue-500 hover:underline break-all">
                {{ basename($tarefa->arquivo) }}
            </a>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('tarefas.index') }}" class="px-4 py-2 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400">Voltar</a>
    </div>
</div>
@endsection
