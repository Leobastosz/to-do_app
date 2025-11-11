@extends('layouts.app')

@section('title', 'Detalhes da Categoria')

@section('header')
    Detalhes da Categoria
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
    @if($categoria->imagem)
    <img src="{{ asset('storage/' . $categoria->imagem) }}" 
         alt="Imagem da categoria" 
         class="w-48 h-48 object-cover rounded shadow-md">
    @endif
    <p class="text-gray-700 dark:text-gray-300" hidden><strong>ID:</strong> {{ $categoria->id }}</p>
    <p class="text-gray-700 dark:text-gray-300"><strong>Nome:</strong> {{ $categoria->nome }}</p>
     <p class="text-gray-700 dark:text-gray-300"><strong>Descrição:</strong> {{ $categoria->descricao }}</p>
    

    <a href="{{ route('categorias.index') }}" class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Voltar
    </a>
</div>
@endsection
