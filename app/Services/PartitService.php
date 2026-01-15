<?php

namespace App\Services;

use App\Repositories\PartitRepository;

class PartitService
{
    public function __construct(private PartitRepository $repo) {}

    /**
     * Llista tots els partits
     */
    public function llistar()
    {
        return $this->repo->getAll();
    }

    /**
     * Troba un partit per ID
     */
    public function trobar($id)
    {
        return $this->repo->find($id);
    }

    /**
     * Desa un nou partit
     */
    public function guardar(array $data)
    {
        return $this->repo->create($data);
    }

    /**
     * Actualitza un partit existent
     */
    public function actualitzar($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * Elimina un partit per ID
     */
    public function eliminar($id)
    {
        return $this->repo->delete($id);
    }
}
