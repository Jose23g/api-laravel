<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  use HasFactory;

  protected $table = 'Producto';

  protected $fillable = [
    'Codigo_producto',
    'Nombre',
    'id_presentacion',
    'id_unidad',
    'Precio_venta'
  ];

  public $timestamps = false;
}
