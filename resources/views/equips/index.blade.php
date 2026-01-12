@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="title">Listado de equipos</h1>

  <div class="grid-cards">
    @foreach ($equips as $equip)
      <article class="card">
        <header class="card__header">
          <h2 class="card__title">{{ $equip->nom }}</h2>
          <span class="card__badge">ID: {{ $equip->id }}</span>
        </header>

        <div class="card__body">
          <p><strong>Ciudad:</strong> {{ $equip->ciutat ?? '—' }}</p>
          <p><strong>Estadio:</strong> {{ $equip->estadi->nom ?? '—' }}</p>
          <p><strong>Edat mitjana jugadoras:</strong> 
              {{ $equip->edadMediaJugadoras() ?? '—' }} anys
          </p>

          <div>
            <strong>Últims 5 partits:</strong>
            @php $ultims = $equip->ultimsPartits() @endphp
            @if($ultims->isEmpty())
              <p>No hi ha partits registrats.</p>
            @else
              <ul class="list-disc pl-5">
                @foreach($ultims as $partit)
                  <li>
                    {{ $partit->data }}: {{ $partit->local->nom ?? '-' }} 
                    {{ $partit->gols ?? '-' }} 
                    {{ $partit->visitant->nom ?? '-' }}
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>

        <footer class="card__footer">
          <a class="btn btn--ghost" href="{{ route('equips.show', $equip) }}">Ver</a>
          <a class="btn btn--primary" href="{{ route('equips.edit', $equip) }}">Editar</a>

          <form method="POST" action="{{ route('equips.destroy', $equip) }}" class="inline">
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
