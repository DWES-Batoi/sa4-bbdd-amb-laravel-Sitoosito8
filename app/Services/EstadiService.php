<?php
namespace App\Services;

use App\Models\Estadi;
use App\Repositories\BaseRepository;

class EstadiService {
    public function __construct(private BaseRepository $repo) {}

    public function guardar(array $data): Estadi {
        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data): Estadi {
        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void {
        $this->repo->delete($id);
    }

    public function llistar() {
        return $this->repo->getAll();
    }
}
