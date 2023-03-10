<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones';

    protected $fillable = [
        'fecha_cotizacion',
        'm2',
        'condiciones',
        'acabados',
        'recamaras',
        'baños',
        'cocheras',
        'cuartos_servicio',
        'cuarto_lavado',
        'estudio',
        'sala_tv',
        'vestidor',
        'portico',
        'otro',
        'total',
    ];

    public $timestamps = false;
}
