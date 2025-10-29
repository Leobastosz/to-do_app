@extends('layouts.main')

@section('title', 'Tarefas')
@section('header', 'Lista de Tarefas')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Tarefas Cadastradas</h3>
    <a href="{{ route('tarefas.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
       Nova Tarefa
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Título</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Categoria</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Data limite</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Concluída</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($tarefas as $tarefa)
                <tr>
                    <td class="px-6 py-4">{{ $tarefa->titulo }}</td>
                    <td class="px-6 py-4">{{ $tarefa->categoria->nome ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $tarefa->data_limite ? date('d/m/Y', strtotime($tarefa->data_limite)) : '-' }}</td>
                    <td class="px-6 py-4">
                        @if($tarefa->concluida)
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full text-xs">Sim</span>
                        @else
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full text-xs">Não</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('tarefas.show', $tarefa) }}" class="text-blue-600 hover:underline mr-2">Ver</a>
                        <a href="{{ route('tarefas.edit', $tarefa) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline" onclick="return confirm('Excluir esta tarefa?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhuma tarefa encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
