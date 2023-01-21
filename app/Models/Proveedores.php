<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proveedores extends Model
{
    use HasFactory;
    protected $table = 'Proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'Nombre',
        'Cedula_juridica'
    ];

    public $timestamps = false;

    public function producto(): BelongsToMany
    {
        return $this->belongsToMany(
            Producto::class,
            'Producto_Proveedores',
            'id_proveedor',
            'id_producto'
        )->withPivot('price');
    }
}