<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelAcabadosCondiciones extends Model
{
    use HasFactory;
    protected $table = 'rel_acabados_condiciones';
    protected $fillable = [
        'condicion_id',
        'acadado_id',
    ];
    public $timestamps = false;

    public function condicion()
    {
        return $this->belongsTo(Condiciones::class, 'condicion_id');
    }

    public function acabado()
    {
        return $this->belongsTo(Acabados::class, 'acadado_id');
    }
}
