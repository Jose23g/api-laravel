<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Proveedores extends Model
{
    use HasFactory;
    protected $table = 'Producto_Proveedores';

    protected $fillable = [
        'id_producto',
        'id_proveedor',
    ];
    public $timestamps = false;
}