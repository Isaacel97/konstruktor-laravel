<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $fillable = [
        'nombre',
        'condicion_id',
        'm2'
    ];
    public $timestamps = false;
    
    public function condicion()
    {
        return $this->belongsTo(Condiciones::class, 'condicion_id');
    }
    
}
