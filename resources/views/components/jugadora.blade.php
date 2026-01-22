@props([
    'nom',
    'equip',
    'dorsal',
    'data_naixement' ,
    'foto' => null
])

<div class="jugadora border rounded-lg shadow-md p-4 bg-white">
  <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>

 <p><strong>Equipo:</strong>{{ $equip }}</p>
 <p><strong>Dorsal:</strong>{{ $dorsal }}</p>
 <p><strong>Fecha Nacimiento:</strong> {{ $data_naixement }}</p>


</div>