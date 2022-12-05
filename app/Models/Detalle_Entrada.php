<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Entrada extends Model
{
    use HasFactory;

    protected $table = 'Detalle_Entrada';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_pedido',
        'Cantidad'
    ];
}
