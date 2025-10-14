@extends('layouts.main')

@section('title', 'Dashboard')

@section('header', 'Painel Principal')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Bem-vindo, {{ Auth::user()->name }}!
            </h3>
            <p class="text-gray-600 dark:text-gray-300">
                Você está logado com sucesso. Utilize o menu acima para navegar pelo sistema.
            </p>
        </div>
    </div>
@endsection
