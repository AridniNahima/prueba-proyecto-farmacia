<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ProveedoresModel;
use App\Models\VentasModel;
use App\Models\ComprasModel;

class inicio extends BaseController
{
    protected $productos, $ventas, $session, $proveedores, $compras;

    public function __construct()
    {
        $this->productos = new ProductosModel();
        $this->proveedores = new ProveedoresModel();
        $this->ventas = new VentasModel();
        $this->compras = new ComprasModel();
        $this->session = session();
    }

    public function index()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $totalProducto = $this->productos->totalProductos();
        
        $fecha = date("Y-m-d");
        $totalVentas = $this->ventas->totalDia($fecha);
        $montoVentas = $this->ventas->totalVentas($fecha);

        $minimos = $this->productos->productosMinimo();


        $totalLaboratorio = $this->proveedores->totalProveedores();
        $totalCompras = $this->compras->totalDia($fecha);
        $montoCompras = $this->compras->totalCompras($fecha);

        $vencidos = $this->productos->productosVencidos($fecha);

        $datos = [
            'totalProducto'  => $totalProducto,
            'totalVentas' => $totalVentas,
            'montoVentas' => $montoVentas,
            'minimos' => $minimos,
            'totalLaboratorio' => $totalLaboratorio,
            'totalCompras' => $totalCompras,
            'montoCompras' => $montoCompras,
            'vencidos' => $vencidos
        ];


        echo view('encabezado');
        echo view('inicio', $datos);
        echo view('pie_pagina');
    }
}
