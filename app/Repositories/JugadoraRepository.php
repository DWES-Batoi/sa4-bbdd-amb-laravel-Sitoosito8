<?php

namespace App\Repositories;

use App\Models\Jugadora;

class JugadoraRepository implements BaseRepository {
    public function getAll() {
        return Jugadora::all();
    }

    public function find($id) {
        return Jugadora::findOrFail($id);
    }

    public function create(array $data) {
        return Jugadora::create($data);
    }

    public function update($id, array $data) {
        $equip = Jugadora::findOrFail($id);
        $equip->update($data);
        return $equip;
    }

    public function delete($id) {
        return Jugadora::destroy($id);
    }
}