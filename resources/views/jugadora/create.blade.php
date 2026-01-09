@extends('layouts.app')
@section('title', 'Afegir una nova jugadora')

@section('content')
<h1 class="text-2xl font-bold mb-4">Afegir una nova jugadora</h1>

@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-2 mb-4">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('jugadoras.store') }}" method="POST" class="space-y-4">
  @csrf

  <div>
    <label for="nom" class="block font-bold">Nom:</label>
    <input
      type="text"
      name="nom"
      id="nom"
      value="{{ old('nom') }}"
      class="border p-2 w-full"
    >
  </div>

  <div>
    <label for="equip" class="block font-bold">Equip:</label>
    <input
      type="text"
      name="equip"
      id="equip"
      value="{{ old('equip') }}"
      class="border p-2 w-full"
    >
  </div>
  <div>
    <label for="dorsal" class="block font-bold">Equip:</label>
    <input
      type="text"
      name="dorsal"
      id="dorsal"
      value="{{ old('dorsal') }}"
      class="border p-2 w-full"
    >
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
    Afegir
  </button>
</form>
@endsection