@extends('layouts.app')
@section('title', 'Editar Partit')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Partit</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('partit.update', $partit) }}" method="POST" class="space-y-4">
  @csrf
  @method('PUT')

  <!-- Jornada -->
  <div>
    <label for="jornada" class="block font-bold">Jornada:</label>
    <input
      type="number"
      name="jornada"
      id="jornada"
      value="{{ old('jornada', $partit->jornada) }}"
      class="border p-2 w-full"
    >
  </div>

  <!-- Data -->
  <div>
    <label for="data" class="block font-bold">Data:</label>
    <input
      type="date"
      name="data"
      id="data"
      value="{{ old('data', \Carbon\Carbon::parse($partit->data)->format('Y-m-d')) }}"
      class="border p-2 w-full"
    >
  </div>

  <!-- Equip Local -->
  <div>
    <label for="local_id" class="block font-bold">Equip Local:</label>
    <select name="local_id" id="local_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}" 
          {{ old('local_id', $partit->local_id) == $equip->id ? 'selected' : '' }}>
          {{ $equip->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- Equip Visitant -->
  <div>
    <label for="visitant_id" class="block font-bold">Equip Visitant:</label>
    <select name="visitant_id" id="visitant_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}" 
          {{ old('visitant_id', $partit->visitant_id) == $equip->id ? 'selected' : '' }}>
          {{ $equip->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- Estadi -->
  <div>
    <label for="estadi_id" class="block font-bold">Estadi:</label>
    <select name="estadi_id" id="estadi_id" class="border p-2 w-full">
      @foreach ($estadis as $estadi)
        <option value="{{ $estadi->id }}" 
          {{ old('estadi_id', $partit->estadi_id) == $estadi->id ? 'selected' : '' }}>
          {{ $estadi->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- Gols -->
  <div>
    <label for="gols" class="block font-bold">Gols:</label>
    <input
      type="text"
      name="gols"
      id="gols"
      value="{{ old('gols', $partit->gols) }}"
      class="border p-2 w-full"
    >
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    Actualitzar
  </button>
</form>
@endsection
