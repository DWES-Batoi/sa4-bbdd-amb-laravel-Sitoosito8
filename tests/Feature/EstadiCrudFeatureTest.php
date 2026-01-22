<?php

namespace Tests\Feature;

use App\Models\Estadi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class EstadiCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Autoriza todo en tests
        Gate::before(fn() => true);
    }

    public function test_es_pot_llistar_estadis()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Estadi::factory()->create(['nom' => 'Camp Nou']);
        Estadi::factory()->create(['nom' => 'Santiago Bernabeu']);

        $resp = $this->get('/estadis');
        $resp->assertStatus(200);
        $resp->assertSee('Camp Nou');
        $resp->assertSee('Santiago Bernabeu');
    }

    public function test_es_pot_crear_un_estadi()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $resp = $this->from(route('estadis.create'))
            ->post('/estadis', [
                'nom' => 'Camp Nou',
                'capacitat' => 99000,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseHas('estadis', ['nom' => 'Camp Nou', 'capacitat' => 99000]);
    }

    public function test_es_pot_actualitzar_un_estadi()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $estadi = Estadi::factory()->create(['nom' => 'Camp Nou', 'capacitat' => 99000]);

        $resp = $this->from(route('estadis.edit', $estadi))
            ->put("/estadis/{$estadi->id}", [
                'nom' => 'Nou Camp',
                'capacitat' => 100000,
            ]);

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseHas('estadis', ['id' => $estadi->id, 'nom' => 'Nou Camp', 'capacitat' => 100000]);
    }

    public function test_es_pot_esborrar_un_estadi()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $estadi = Estadi::factory()->create(['nom' => 'Camp Nou']);

        $resp = $this->from(route('estadis.index'))->delete("/estadis/{$estadi->id}");

        $resp->assertSessionHasNoErrors();
        $resp->assertRedirect(route('estadis.index'));

        $this->assertDatabaseMissing('estadis', ['id' => $estadi->id]);
    }
}
