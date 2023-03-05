<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedido';

    protected $primaryKey = 'id_pedido';

    protected $fillable = [
        'id_usuario',
        'id_estado',
        'fecha'
    ]; 

    public function Detalle_pedido(): HasMany
{
    return $this->hasMany(Detalle_pedido::class, 'id_pedido');
    
}
public function Detalle_entrada(): HasMany
{
    return $this->hasMany(Detalle_Entrada::class, 'id_pedido');
    
}

    public $timestamps = false;
}
