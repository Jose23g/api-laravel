<?php

namespace Tests\Unit;

use App\Models\Producto;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CrearProductoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIngresarNuevoProducto()
    {
        $data = [
               'codigoproducto' => 780,
                'nombre' => "Pollo Frito",
                'presentacion' => 1,
                'unidad' => 2,
                'precioventa' => 850,
        ];

        $response = $this->post('api/producto', $data);

        $response->assertStatus(200);
    }
}