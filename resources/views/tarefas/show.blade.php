@extends('layouts.main')

@section('title', 'Detalhes da Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
    {{-- Título --}}
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ $tarefa->titulo }}</h2>

    {{-- Categoria --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
        <strong>Categoria:</strong>
        {{ $tarefa->categoria->nome ?? '—' }}
    </p>

    {{-- Data limite --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
        <strong>Data limite:</strong>
        @if ($tarefa->data_limite)
            {{ \Carbon\Carbon::parse($tarefa->data_limite)->format('d/m/Y') }}
        @else
            <span class="italic text-gray-400">Sem data definida</span>
        @endif
    </p>

    {{-- Concluída --}}
    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        <strong>Concluída:</strong>
        @if ($tarefa->concluida)
            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Sim</span>
        @else
            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Não</span>
        @endif
    </p>

    {{-- Descrição --}}
    <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $tarefa->descricao }}</p>

    {{-- Arquivo --}}
    @if ($tarefa->arquivo)
        <div class="mt-4">
            <p class="text-gray-700 dark:text-gray-300 mb-2"><strong>Arquivo:</strong></p>
            <a href="{{ Storage::url($tarefa->arquivo) }}" target="_blank"
                class="inline-block text-blue-500 hover:underline break-all">
                {{ basename($tarefa->arquivo) }}
            </a>
        </div>
    @endif

    {{-- Botão voltar --}}
    <div class="mt-6">
        <a href="{{ route('tarefas.index') }}"
           class="px-4 py-2 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400 transition">
            Voltar
        </a>
    </div>
</div>
@endsection
