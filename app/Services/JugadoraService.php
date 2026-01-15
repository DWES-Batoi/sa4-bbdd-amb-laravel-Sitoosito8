<?php

namespace App\Services;

use App\Repositories\JugadoraRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JugadoraService {
    public function __construct(private JugadoraRepository $repo) {}

    public function llistar() {
        return $this->repo->getAll();
    }

    public function trobar($id){
        return $this->repo->find($id);
    }

    public function guardar(array $data, ?UploadedFile $foto = null) {
        if ($foto) {
            // Guarda la foto en storage/app/public/fotos
            $data['foto'] = $foto->store('fotos', 'public');
        }
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data, ?UploadedFile $foto = null) {
        $jugadora = $this->repo->find($id);

        if ($foto) {
            // Borra la foto anterior si existe
            if ($jugadora->foto) {
                Storage::disk('public')->delete($jugadora->foto);
            }
            $data['foto'] = $foto->store('fotos', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar($id) {
        $jugadora = $this->repo->find($id);

        if ($jugadora->foto) {
            Storage::disk('public')->delete($jugadora->foto);
        }

        $this->repo->delete($id);
    }
}
