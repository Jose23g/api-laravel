<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad_Medida extends Model
{
    use HasFactory; 

    protected $table = 'Unidad_Medida';

    protected $fillable = [
        'Nombre',
    ];
}
