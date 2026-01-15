@props([
    'local',
    'visitant',
    'estadi',
    'data',
    'jornada',
    'gols' => null
])

<div class="partit border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-green-700 mb-2">
        Jornada {{ $jornada }} - {{ $data }}
    </h2>

    <p><strong>Local:</strong> {{ $local }}</p>
    <p><strong>Visitant:</strong> {{ $visitant }}</p>
    <p><strong>Estadi:</strong> {{ $estadi }}</p>

    @if($gols)
        <p><strong>Gols:</strong> {{ $gols }}</p>
    @else
        <p><strong>Gols:</strong> Pendiente</p>
    @endif
</div>
