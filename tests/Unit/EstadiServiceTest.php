<?php

namespace Tests\Unit;

use App\Models\Estadi;
use App\Services\EstadiService;
use Mockery;
use Tests\TestCase;
use App\Repositories\BaseRepository;

class EstadiServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_guardar_crea_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);

        $data = ['nom' => 'Camp Nou', 'capacitat' => 99000];

        $repo->shouldReceive('create')
            ->once()
            ->with($data)
            ->andReturn(new Estadi($data));

        $service = new EstadiService($repo);
        $estadi = $service->guardar($data);

        $this->assertEquals('Camp Nou', $estadi->nom);
        $this->assertEquals(99000, $estadi->capacitat);
    }

    public function test_actualitzar_modifica_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);
        $estadi = new Estadi(['id' => 1, 'nom' => 'Camp Nou', 'capacitat' => 99000]);

        $repo->shouldReceive('update')
            ->once()
            ->with(1, ['nom' => 'Nou Camp', 'capacitat' => 100000])
            ->andReturn($estadi);

        $service = new EstadiService($repo);
        $updated = $service->actualitzar(1, ['nom' => 'Nou Camp', 'capacitat' => 100000]);

        $this->assertInstanceOf(Estadi::class, $updated);
    }

    public function test_eliminar_estadi()
    {
        $repo = Mockery::mock(BaseRepository::class);
        $repo->shouldReceive('delete')->once()->with(1);

        $service = new EstadiService($repo);
        $service->eliminar(1);

        $this->assertTrue(true); // Simple check que no lanza excepción
    }
}
