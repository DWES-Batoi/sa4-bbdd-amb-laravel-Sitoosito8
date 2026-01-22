@extends('layouts.equip')
@section('title', 'Editar Jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Jugadora</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('jugadora.update', $jugadora) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <!-- Nom -->
  <div>
    <label for="nom" class="block font-bold">Nom:</label>
    <input
      type="text"
      name="nom"
      id="nom"
      value="{{ old('nom', $jugadora->nom) }}"
      class="border p-2 w-full"
    >
  </div>

  <!-- Equip -->
  <div>
    <label for="equip_id" class="block font-bold">Equip:</label>
    <select name="equip_id" id="equip_id" class="border p-2 w-full">
      @foreach ($equips as $equip)
        <option value="{{ $equip->id }}"
          {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
          {{ $equip->nom }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- Data de naixement -->
  <div>
    <label for="data_naixement" class="block font-bold">Data de naixement:</label>
    <input
      type="date"
      name="data_naixement"
      id="data_naixement"
      value="{{ old('data_naixement', \Carbon\Carbon::parse($jugadora->data_naixement)->format('Y-m-d')) }}"
      class="border p-2 w-full"
    >
  </div>

  <!-- Dorsal -->
  <div>
    <label for="dorsal" class="block font-bold">Dorsal:</label>
    <input
      type="number"
      name="dorsal"
      id="dorsal"
      value="{{ old('dorsal', $jugadora->dorsal) }}"
      class="border p-2 w-full"
    >
  </div>

  <!-- Foto -->
  <div>
    <label for="foto" class="block font-bold">Foto:</label>
    <input
      type="file"
      name="foto"
      id="foto"
      class="border p-2 w-full"
    >

    @if ($jugadora->foto)
      <p class="mt-2 text-sm text-gray-600">Foto actual:</p>
      <img src="{{ asset('storage/' . $jugadora->foto) }}" class="h-24 mt-1">
    @endif
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    Actualitzar
  </button>
</form>
@endsection
