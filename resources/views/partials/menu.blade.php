<nav>
  <ul class="flex space-x-4">
    <li><a class="text-white hover:underline" href="/">Inici</a></li>

    {{-- Opcional: activarem l'enllaç d'equips quan el service estiga creat --}}
    {{--  --}}

    <li><a class="text-white hover:underline" href="{{ route('estadis.index') }}">Llistat d'Estadis</a></li>
    <li><a class="text-white hover:underline" href="{{ route('equips.index') }}">Llistat d'Equips</a></li>
    <li><a class="text-white hover:underline" href="{{ route('jugadora.index') }}">Llistat de Jugadoras</a></li>
        <li><a class="text-white hover:underline" href="{{ route('partit.index') }}">Llistat de partits</a></li>
  </ul>
</nav>