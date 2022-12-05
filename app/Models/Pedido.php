<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'Pedido';

    protected $fillable = [
        'id_usuario',
        'fecha',
        'total'
    ]; 

    public $timestamps = false;
}
