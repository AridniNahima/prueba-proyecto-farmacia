<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;
//use FPDF;
class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $producto, $configuracion,$session;
    protected $reglas;

    public function __construct()
    {
        $this->compras = new ComprasModel();
        $this->detalle_compra = new DetalleCompraModel();
        $this->configuracion = new ConfiguracionModel();
        $this->session = session();
        helper(['form']);
    }

    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }

        $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Historial Compras', 'datos' => $compras];

        echo view('encabezado');
        echo view('compras/compras_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Compras eliminadas', 'datos' => $compras];

        echo view('encabezado');
        echo view('compras/eliminadas_compras_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        echo view('encabezado');
        echo view('compras/nuevo_compras_view');
        echo view('pie_pagina');
    }

    public function guarda()
    {
        $id_compra = $this->request->getPost('id_compra');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));

        $session = session(); //session activa del usuario x

        $resultadoId = $this->compras->insertaCompra($id_compra, $total, $session->id_usuario);

        $this->temporal_compra = new TemporalCompraModel();

        if ($resultadoId) {
            $resultadoCompra = $this->temporal_compra->porCompra($id_compra);
            foreach ($resultadoCompra as $row) {
                $this->detalle_compra->save([
                    'id_compra' => $resultadoId,
                    'cod_producto' => $row['cod_producto'],
                    'nombre' => $row['nombre'],
                    'nombreg' => $row['nombreg'],
                    'cantidad' => $row['cantidad'],
                    'precio' => $row['precio']
                ]);
                $this->producto = new ProductosModel();
                $this->producto->actualizaStock($row['cod_producto'], $row['cantidad']);
            }
            $this->temporal_compra->eliminarTemporalCompra($id_compra);
        }
        return redirect()->to(base_url() . "/compras/muestraCompraPdf/" . $resultadoId);
    }

    function muestraCompraPdf($id_compra)
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        $data['id_compra'] = $id_compra;
        echo view('encabezado');
        echo view('compras/ver_compra_pdf', $data);
        echo view('pie_pagina');
    }

    function generaCompraPdf($id_compra)
    {
        $datosCompra = $this->compras->where('id_compra', $id_compra)->first();
        $detalleCompra = $this->detalle_compra->select('*')->where('id_compra', $id_compra)->findAll();
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;


        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Compra");
        $pdf->SetFont('Arial', 'B', 16); //Arial, negrita, 10

        $pdf->Cell(195, 5, "Entrada de productos", 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 9);

        $pdf->Ln();

        $pdf->Image(base_url() . '/images/logotipo.png', 175, 10, 30, 20, 'PNG');
        $pdf->Cell(50, 5, utf8_decode($nombreTienda), 0, 1, 'L');
        $pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, utf8_decode($direccionTienda), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode("Fecha y hora: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosCompra['fecha_alta'], 0, 1, 'L');


        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, 'Detalle de productos', 1, 1, 'C', 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, 'No', 1, 0, 'L');
        $pdf->Cell(25, 5, utf8_decode("Código"), 1, 0, 'L');
        $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Importe', 1, 1, 'L');

        $pdf->SetFont('Arial', '', 9);

        $contador = 1;

        foreach ($detalleCompra as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(25, 5, $row['cod_producto'], 1, 0, 'L');
            $pdf->Cell(77, 5, $row['nombre'], 1, 0, '');
            $pdf->Cell(25, 5, $row['precio'], 1, 0, '');
            $pdf->Cell(25, 5, $row['cantidad'], 1, 0, '');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(30, 5, 'Bs ' . $importe, 1, 1, '');
            $contador
            ++;
        }

        $pdf->Ln(); //Salto de linea

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 5, 'Total: Bs ' . number_format($datosCompra['total'], 2, '.', ','), 0, 1, 'R');

        $pdf->Output("compra_pdf.pdf", "I");
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output(); //Salida al navegador del pdf

    }
}
