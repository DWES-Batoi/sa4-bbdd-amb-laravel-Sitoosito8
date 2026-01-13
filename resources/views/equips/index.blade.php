@extends('layouts.equip')

@section('title', 'Listado de Equipos')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Listado de Equipos</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($equips as $equip)
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-4 flex flex-col justify-between">
                
                <!-- Escudo y nombre del equipo -->
                <div class="text-center mb-4">
                    @if($equip->escut)
                        <img 
                            src="{{ asset('storage/' . $equip->escut) }}" 
                            alt="{{ $equip->nom }}" 
                            class="mx-auto h-24 w-24 object-cover rounded-full mb-2 border border-gray-300"
                        >
                    @endif
                    <h2 class="text-xl font-bold">{{ $equip->nom }}</h2>
                    <span class="text-sm text-gray-500">ID: {{ $equip->id }}</span>
                </div>

                <!-- Información del equipo -->
                <div>
                    <p><strong>Ciudad:</strong> {{ $equip->ciutat ?? '—' }}</p>
                    <p><strong>Estadio:</strong> {{ $equip->estadi->nom ?? '—' }}</p>
                    <p><strong>Edat mitjana jugadoras:</strong> {{ $equip->edadMediaJugadoras() ?? '—' }} anys</p>

                    <div class="mt-2">
                        <strong>Últims 5 partits:</strong>
                        @php $ultims = $equip->ultimsPartits() @endphp
                        @if($ultims->isEmpty())
                            <p>No hi ha partits registrats.</p>
                        @else
                            <ul class="list-disc pl-5">
                                @foreach($ultims as $partit)
                                    <li>
                                        {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}: 
                                        {{ $partit->local->nom ?? '-' }} 
                                        {{ $partit->gols ?? '-' }} 
                                        {{ $partit->visitant->nom ?? '-' }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Footer con acciones -->
                <footer class="mt-4 flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('equips.show', $equip) }}" class="text-blue-600 hover:underline">Ver</a>
                    <a href="{{ route('equips.edit', $equip) }}" class="text-yellow-600 hover:underline">Editar</a>
                    <form method="POST" action="{{ route('equips.destroy', $equip) }}" onsubmit="return confirm('Segur que vols eliminar aquest equip?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </footer>
            </div>
        @endforeach
    </div>
</div>
@endsection
