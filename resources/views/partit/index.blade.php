@extends('layouts.equip')
@section('title', "Listado de Partits")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Listado de Partits</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('partit.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Nou Partit
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($partits as $partit)
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">Jornada {{ $partit->jornada }}</h2>
                    <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</p>
                    <p><strong>Local:</strong> {{ $partit->local->nom ?? '-' }}</p>
                    <p><strong>Visitant:</strong> {{ $partit->visitant->nom ?? '-' }}</p>
                    <p><strong>Estadi:</strong> {{ $partit->estadi->nom ?? '-' }}</p>
                    <p><strong>Gols:</strong> {{ $partit->gols ?? 'Pendiente' }}</p>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('partit.show', $partit) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('partit.edit', $partit) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('partit.destroy', $partit) }}" onsubmit="return confirm('Segur que vols eliminar?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
