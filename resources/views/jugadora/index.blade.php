@extends('layouts.app')
@section('title', "Guia de Jugadores")

@section('content')
<div class="container">
  <h1 class="text-3xl font-bold text-blue-800 mb-6">Listado de Jugadoras</h1>

  @if (session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4">
      {{ session('success') }}
    </div>
  @endif

  <p class="mb-4">
    <a href="{{ route('jugadora.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">
      Nova Jugadora
    </a>
  </p>

  <div class="grid-cards">
    @foreach ($jugadoras as $jugadora)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $jugadora->nom }}</h2>

          @if ($jugadora->data_naixement)
            <span class="card__badge">
              {{ \Carbon\Carbon::parse($jugadora->data_naixement)->format('d/m/Y') }}
            </span>
          @endif
        </header>

        <div class="card__body">
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

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('jugadora.show', $jugadora) }}">
            Ver
          </a>

          <a class="btn btn--primary" href="{{ route('jugadora.edit', $jugadora) }}">
            Editar
          </a>

          <form method="POST" action="{{ route('jugadora.destroy', $jugadora) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">
              Eliminar
            </button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection
