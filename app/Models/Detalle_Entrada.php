<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detalle_Entrada extends Model
{
    use HasFactory;

    protected $table = 'Detalle_entrada';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_pedido',
        'Cantidad'
    ]; 

    public function Pedido (): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
}
