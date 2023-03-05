<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detalle_pedido extends Model
{
    use HasFactory;
    protected $table = 'Detalle_pedido';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_producto',
        'id_pedido',
        'id_proveedor',
        'cantidad',
        'total_linea',
    ]; 

    public function Pedido (): BelongsTo
{
    return $this->belongsTo(Pedido::class, 'id_pedido');
}

    public $timestamps = false;
}
