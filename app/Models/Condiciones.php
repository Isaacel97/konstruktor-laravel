<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condiciones extends Model
{
    use HasFactory;
    protected $table = 'condiciones';
    protected $fillable = [
        'condicion',
        'm2'
    ];
    public $timestamps = false;
}
