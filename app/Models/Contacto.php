<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = 'contactos';
    protected $fillable = [
        'fecha',
        'nombre',
        'direccion',
        'telefono',
        'origen_id',
        'status',
    ];
    public $timestamps = false;
}
