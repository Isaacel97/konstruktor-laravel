<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = 'cotizaciones';

    protected $fillable = [
        'id_user',
        'fecha_cotizacion',
        'm2',
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
        'status_id',
        'id_acabados',
        'id_condicion',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function acabado()
    {
        return $this->belongsTo(Acabados::class, 'id_acabados');
    }

    public function condicion()
    {
        return $this->belongsTo(Condiciones::class, 'id_condicion');
    }
}
