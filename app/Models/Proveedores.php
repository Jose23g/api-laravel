<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    protected $table = 'Proveedores';

    protected $fillable = [
        'Nombre',
        'Cedula_juridica'
    ];
   
    public $timestamps = false;
}
