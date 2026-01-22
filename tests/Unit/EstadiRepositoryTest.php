<?php

namespace Tests\Unit;

use App\Models\Estadi;
use App\Repositories\EstadiRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstadiRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EstadiRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new EstadiRepository();
    }

    public function test_create_i_find()
    {
        $estadi = $this->repo->create([
            'nom' => 'Camp Nou',
            'capacitat' => 99000,
        ]);

        $this->assertDatabaseHas('estadis', ['nom' => 'Camp Nou']);
        $this->assertEquals('Camp Nou', $this->repo->find($estadi->id)->nom);
    }

    public function test_update_modifica_estadi()
    {
        $estadi = Estadi::factory()->create(['nom' => 'Antic', 'capacitat' => 50000]);

        $this->repo->update($estadi->id, ['nom' => 'Nou', 'capacitat' => 55000]);

        $this->assertDatabaseHas('estadis', ['id' => $estadi->id, 'nom' => 'Nou', 'capacitat' => 55000]);
    }

    public function test_delete_esborra_estadi()
    {
        $estadi = Estadi::factory()->create();

        $this->repo->delete($estadi->id);

        $this->assertDatabaseMissing('estadis', ['id' => $estadi->id]);
    }

    public function test_getAll_retorna_tots()
    {
        Estadi::factory()->count(3)->create();

        $estadis = $this->repo->getAll();

        $this->assertCount(3, $estadis);
    }
}
