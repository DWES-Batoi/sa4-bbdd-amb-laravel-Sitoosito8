@extends('layouts.equip')
@section('title', "Guia de Jugadoras")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Listado de Jugadoras</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('jugadora.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Nova Jugadora
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($jugadoras as $jugadora)
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">{{ $jugadora->nom }}</h2>

                    @if ($jugadora->data_naixement)
                        <p class="text-sm text-gray-500 mb-2">
                            {{ \Carbon\Carbon::parse($jugadora->data_naixement)->format('d/m/Y') }}
                        </p>
                    @endif

                    <p><strong>Equip:</strong> {{ $jugadora->equip->nom ?? '-' }}</p>
                    <p><strong>Dorsal:</strong> {{ $jugadora->dorsal ?? '-' }}</p>

                    @if ($jugadora->foto)
                        <img 
                            src="{{ asset('storage/fotos/' . $jugadora->foto) }}" 
                            alt="{{ $jugadora->nom }}" 
                            class="mt-2 h-24 w-24 object-cover rounded"
                        >
                    @endif
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <a href="{{ route('jugadora.show', $jugadora) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('jugadora.edit', $jugadora) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('jugadora.destroy', $jugadora) }}" onsubmit="return confirm('Segur que vols eliminar?');">
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
