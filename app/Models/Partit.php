<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Partit
 */
class Partit extends Model
{
    use HasFactory;
    protected $fillable = ['local_id', 'visitant_id', 'estadi_id', 'data', 'jornada', 'gols'];

    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    public function estadi(){
        return $this->belongsTo(Estadi::class);
    }


}