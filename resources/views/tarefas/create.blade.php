@extends('layouts.main')

@section('title', 'Criar Tarefa')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Nova Tarefa</h2>

    {{-- Mensagens de sucesso/erro via SweetAlert --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                })
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#d33',
                })
            });
        </script>
    @endif

    <form action="{{ route('tarefas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Título --}}
        <div>
            <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título</label>
            <input type="text" id="titulo" name="titulo"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        {{-- Descrição --}}
        <div>
            <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descrição</label>
            <textarea id="descricao" name="descricao" rows="4"
                class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        {{-- Upload de arquivo --}}
        <div>
            <label for="arquivo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anexar Arquivo</label>
            <input type="file" id="arquivo" name="arquivo"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Arquivos até 20 MB (imagens, PDF, DOC, etc.)</p>
        </div>

        {{-- Botões --}}
        <div class="flex justify-end gap-4">
            <a href="{{ route('tarefas.index') }}"
                class="px-4 py-2 rounded-md bg-gray-300 text-gray-700 hover:bg-gray-400 transition">Cancelar</a>
            <button type="submit"
                class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">Salvar</button>
        </div>
    </form>
</div>
@endsection
