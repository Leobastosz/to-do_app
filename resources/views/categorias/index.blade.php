@extends('layouts.main')

@section('title', 'Categorias')

@section('header', 'Lista de Categorias')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Categorias Cadastradas</h3>
        <a href="{{ route('categorias.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
           Nova Categoria
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Descrição</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Ações</th>
                </tr>
            </thead>
            
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($categorias as $categoria)
                    <tr>
                        <td class="px-6 py-4">{{ $categoria->nome }}</td>
                        <td class="px-6 py-4">{{ $categoria->descricao ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('categorias.show', $categoria) }}" class="text-blue-600 hover:underline mr-2">Ver</a>
                            <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Excluir esta categoria?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Nenhuma categoria encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
