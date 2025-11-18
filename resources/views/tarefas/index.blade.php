@extends('layouts.main')

@section('title', 'Tarefas')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Minhas Tarefas</h2>
        <a href="{{ route('tarefas.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Nova Tarefa</a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Categoria</th>
                    <th class="px-4 py-2">Data Limite</th>
                    <th class="px-4 py-2">Concluída</th>
                    <th class="px-4 py-2">Arquivo</th>
                    <th class="px-4 py-2 text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tarefas as $tarefa)
                    <tr class="border-b dark:border-gray-700">
                        
                        {{-- Título --}}
                        <td class="px-4 py-3">{{ $tarefa->titulo }}</td>

                        {{-- Categoria --}}
                        <td class="px-4 py-3">
                            {{ $tarefa->categoria->nome ?? '—' }}
                        </td>

                        {{-- Data limite --}}
                        <td class="px-4 py-3">
                            @if ($tarefa->data_limite)
                                {{ \Carbon\Carbon::parse($tarefa->data_limite)->format('d/m/Y') }}
                            @else
                                <span class="text-gray-400 italic">Sem data</span>
                            @endif
                        </td>

                        {{-- Concluída --}}
                        <td class="px-4 py-3 text-center">
                            @if ($tarefa->concluida)
                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Sim</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">Não</span>
                            @endif
                        </td>

                        {{-- Arquivo --}}
                        <td class="px-4 py-3">
                            @if ($tarefa->arquivo)
                                <a href="{{ Storage::url($tarefa->arquivo) }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ basename($tarefa->arquivo) }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Nenhum</span>
                            @endif
                        </td>

                        {{-- Ações --}}
                        <td class="px-4 py-3 text-right space-x-2">

                            {{-- Ver --}}
                            <a href="{{ route('tarefas.show', $tarefa->id) }}" class="text-green-500 hover:underline">Ver</a>

                            {{-- Editar --}}
                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="text-yellow-500 hover:underline">Editar</a>

                            {{-- Botão marcar como concluída --}}
                            @if (!$tarefa->concluida)
                                <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')

                                    {{-- Inputs ocultos para não perder os outros campos obrigatórios --}}
                                    <input type="hidden" name="titulo" value="{{ $tarefa->titulo }}">
                                    <input type="hidden" name="descricao" value="{{ $tarefa->descricao }}">
                                    <input type="hidden" name="categoria_id" value="{{ $tarefa->categoria_id }}">
                                    <input type="hidden" name="data_limite" value="{{ $tarefa->data_limite }}">
                                    <input type="hidden" name="concluida" value="1">

                                    <button type="submit" class="text-blue-600 hover:underline">
                                        Concluir
                                    </button>
                                </form>
                            @endif

                            {{-- Excluir --}}
                            <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Nenhuma tarefa encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Confirmação SweetAlert2 --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.delete-form');
    forms.forEach(form => {
        form.addEventListener('submit', e => {
            e.preventDefault();
            Swal.fire({
                title: 'Excluir tarefa?',
                text: 'Esta ação não poderá ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
});
</script>
@endsection
