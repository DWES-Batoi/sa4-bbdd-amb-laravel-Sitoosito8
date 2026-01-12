@extends('layouts.app')
@section('title', "Listado de Partits")

@section('content')
<div class="container">
  <h1 class="text-3xl font-bold text-green-700 mb-6">Listado de Partits</h1>

  @if (session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4">{{ session('success') }}</div>
  @endif

  <p class="mb-4">
    <a href="{{ route('partit.create') }}" class="bg-green-600 text-white px-3 py-2 rounded">
      Nou Partit
    </a>
  </p>

  <div class="grid-cards">
    @foreach ($partits as $partit)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">Jornada {{ $partit->jornada }}</h2>
          <span class="card__badge">{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</span>
        </header>

        <div class="card__body">
          <p><strong>Local:</strong> {{ $partit->local->nom ?? '-' }}</p>
          <p><strong>Visitant:</strong> {{ $partit->visitant->nom ?? '-' }}</p>
          <p><strong>Estadi:</strong> {{ $partit->estadi->nom ?? '-' }}</p>
          <p><strong>Gols:</strong> {{ $partit->gols ?? 'Pendiente' }}</p>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('partit.show', $partit) }}">Ver</a>
          <a class="btn btn--primary" href="{{ route('partit.edit', $partit) }}">Editar</a>

          <form method="POST" action="{{ route('partit.destroy', $partit) }}" class="inline">
            @csrf
            @method('DELETE')
            <button class="btn btn--danger" type="submit">Eliminar</button>
          </form>
        </footer>
      </article>
    @endforeach
  </div>
</div>
@endsection
