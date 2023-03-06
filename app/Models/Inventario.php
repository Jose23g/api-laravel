<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'Inventario';

    protected $fillable = [
        'id_producto',
        'cantidad'
    ];
    public $timestamps = false;
}
