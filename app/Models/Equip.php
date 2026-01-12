<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'estadi_id', 'titols', 'ciutat'];

    // Relaciones
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    public function jugadoras()
    {
        return $this->hasMany(Jugadora::class);
    }

    public function partitsLocals()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitants()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function partits()
    {
        // Combina los partidos como local y visitante
        return $this->partitsLocals()->union($this->partitsVisitants());
    }

    // Edad media de las jugadoras
    public function edadMediaJugadoras(): ?float
    {
        if ($this->jugadoras()->count() === 0) {
            return null;
        }

        $totalEdad = 0;
        $hoy = Carbon::today();

        foreach ($this->jugadoras as $jugadora) {
            $totalEdad += $hoy->diffInYears(Carbon::parse($jugadora->data_naixement));
        }

        return round($totalEdad / $this->jugadoras->count(), 1); // 1 decimal
    }

    // Últimos 5 partidos
    public function ultimsPartits()
    {
        return Partit::where('local_id', $this->id)
                    ->orWhere('visitant_id', $this->id)
                    ->orderBy('data', 'desc')
                    ->limit(5)
                    ->get();
    }
}
