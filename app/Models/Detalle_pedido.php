<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{
    use HasFactory;
    protected $table = 'Detalle_pedido';

    protected $fillable = [
        'id_producto',
        'id_pedido',
        'id_proveedor',
        'cantidad',
        'total_linea',
    ];

    public $timestamps = false;
}
