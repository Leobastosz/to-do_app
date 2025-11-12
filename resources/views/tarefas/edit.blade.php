@extends('layouts.main')

@section('title', 'Editar Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Editar Tarefa</h2>

    <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Categoria (somente visualização) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoria</label>
            <input type="text" value="{{ $tarefa->categoria->nome ?? 'Sem categoria' }}" readonly
                class="w-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border-gray-300 dark:border-gray-600 rounded-md shadow-sm cursor-not-allowed" />
            {{-- Campo oculto que será enviado --}}
            <input type="hidden" name="categoria_id" value="{{ $tarefa->categoria_id }}">
        </div>

        {{-- Título --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título</label>
            <input type="text" name="titulo" value="{{ $tarefa->titulo }}" required
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        {{-- Descrição --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descrição</label>
            <textarea name="descricao" rows="4"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $tarefa->descricao }}</textarea>
        </div>

        {{-- Data limite --}}
        <div>
            <label for="data_limite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data
                limite</label>
            <input type="date" id="data_limite" name="data_limite"
                value="{{ $tarefa->data_limite ? \Carbon\Carbon::parse($tarefa->data_limite)->format('Y-m-d') : '' }}"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Checkbox concluída --}}
        <div class="flex items-center">
            <input type="checkbox" id="concluida" name="concluida" value="1" {{ $tarefa->concluida ? 'checked' : '' }}
                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <label for="concluida" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                Marcar como concluída
            </label>
        </div>

        {{-- Substituir arquivo --}}
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

        {{-- Botões --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('tarefas.index') }}"
                class="px-4 py-2 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400">Cancelar</a>
            <button type="submit"
                class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Atualizar</button>
        </div>
    </form>
</div>
@endsection