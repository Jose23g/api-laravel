<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
  use HasFactory;

  protected $table = 'Producto';
  protected $primaryKey = 'id_producto';


  protected $fillable = [
    'Codigo_producto',
    'Nombre',
    'id_presentacion',
    'id_unidad',
    'Precio_venta'
  ];

  public $timestamps = false;

  public function proveedores(): BelongsToMany
  {
    return $this->belongsToMany(Proveedores::class, 'Producto_Proveedores', 'id_producto', 'id_proveedor');
  }
}