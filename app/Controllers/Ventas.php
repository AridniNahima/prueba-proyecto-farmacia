<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\TemporalCompraModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionModel;
use App\Models\CajasModel;
use App\Models\ArqueoCajaModel;
use FPDF;

class Ventas extends BaseController
{
    protected $ventas, $temporal_venta, $detalle_venta, $producto, $configuracion, $cajas, $session, $arqueoModel;

    public function __construct()
    {
        $this->ventas = new VentasModel();
        $this->detalle_venta = new DetalleVentaModel();
        $this->configuracion = new ConfiguracionModel();
        $this->producto = new ProductosModel();
        $this->cajas = new CajasModel();
        $this->arqueoModel = new ArqueoCajaModel();
        $this->session = session();
        helper(['form']);
    }

    public function index()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $datos = $this->ventas->obtener(1);
        $data = ['titulo' => 'Historial Ventas', 'datos' => $datos];

        echo view('encabezado');
        echo view('ventas/ventas_view', $data);
        echo view('pie_pagina');
    }

    public function venta()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $existe = $this->arqueoModel->where(['id_caja' => $this->session->id_caja, 'estado' => 1])->countAllResults();

        if ($existe == 0) {
            echo 'No abriste tu caja, ve al proceso de apertura de caja';
            exit;
        }

        echo view('encabezado');
        echo view('ventas/nuevo_ventas');
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        $ventas = $this->ventas->obtener(0);
        $data = ['titulo' => 'Ventas eliminadas', 'datos' => $ventas];

        echo view('encabezado');
        echo view('ventas/eliminadas_ventas_view', $data);
        echo view('pie_pagina');
    }
    public function borrar($id_venta)
    {
        $productos = $this->detalle_venta->where('id_venta', $id_venta)->findAll();

        foreach ($productos as $producto) {
            $this->producto->actualizaStock($producto['cod_producto'], $producto['cantidad'], '+');
        }
        $this->ventas->update($id_venta, ['activo' => 0]);
        return redirect()->to(base_url() . '/ventas');
    }

    public function guarda()
    {
        $id_venta = $this->request->getPost('id_venta');
        $forma_pago = $this->request->getPost('forma_pago');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));


        $caja = $this->cajas->where('id_caja', $this->session->id_caja)->first();
        $folio = $caja['folio'];

        $resultadoId = $this->ventas->insertaVenta($folio, $total, $this->session->id_usuario, $this->session->id_caja, $forma_pago);

        $this->temporal_venta = new TemporalCompraModel();

        if ($resultadoId) {
            $folio++;
            $this->cajas->update($this->session->id_caja, ['folio' => $folio]);

            $resultadoVenta = $this->temporal_venta->porCompra($id_venta);
            foreach ($resultadoVenta as $row) {
                $this->detalle_venta->save([
                    'id_venta' => $resultadoId,
                    'cod_producto' => $row['cod_producto'],
                    'nombre' => $row['nombre'],
                    'nombreg' => $row['nombreg'],
                    'cantidad' => $row['cantidad'],
                    'precio' => $row['precio']
                ]);
                $this->producto = new ProductosModel();
                $this->producto->actualizaStock($row['cod_producto'], $row['cantidad'], '-');
            }
            $this->temporal_venta->eliminarTemporalCompra($id_venta); //VErificar
        }
        return redirect()->to(base_url() . "/ventas/muestraTicket/" . $resultadoId);
    }

    

    function muestraTicket($id_venta)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data['id_venta'] = $id_venta;
        echo view('encabezado');
        echo view('ventas/ver_ticket', $data);
        echo view('pie_pagina');
    }
    function generaTicket($id_venta)
    {
        $datosVenta = $this->ventas->where('id_venta', $id_venta)->first();

        $detalleVenta = $this->detalle_venta->select('*')->where('id_venta', $id_venta)->findAll();

        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
        $ticketLeyenda = $this->configuracion->select('valor')->where('nombre', 'ticket_leyenda')->get()->getRow()->valor;

        $pdf = new FPDF('P', 'mm', array(80, 200));
        $pdf->AddPage();
        $pdf->SetMargins(5, 5, 5);
        $pdf->SetTitle("Venta");
        $pdf->SetFont('Arial', 'B', 9);

        //$pdf->Cell(70, 5, utf8_decode($nombreTienda), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Image(base_url() . '/images/logotipo.png', 30, 3, 20, 10, 'PNG');

        $pdf->Ln(5); //Salto de linea

        $pdf->SetFont('Arial', '', 8);
        $pdf->MultiCell(70, 4, utf8_decode($direccionTienda), 0, 'C', 0);
        //$pdf->MultiCell(70, 4, utf8_decode($ticketLeyenda), 0, 'C', 0);
        $pdf->Ln(); //Salto de linea
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(20, 2, 'Fecha y hora: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(50, 2, $datosVenta['fecha_alta'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(10, 5, 'Ticket: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(50, 5, $datosVenta['folio'], 0, 1, 'L');

        // $pdf->Ln(); //Salto de linea
        //DETALLE VENTA
        $pdf->SetFont('Arial', 'B', 8);

        $pdf->Cell(10, 5, 'Cant.', 0, 0, 'L');
        $pdf->Cell(32, 5, 'Nombre', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Precio', 0, 0, 'L');
        $pdf->Cell(15, 5, 'Importe', 0, 1, 'L');

        $pdf->SetFont('Arial', '', 8);

        foreach ($detalleVenta as $row) {

            $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'C');
            $pdf->Cell(32, 5, $row['nombre'], 0, 0, 'L');
            $pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
            $importe = number_format($row['cantidad'] * $row['precio'], 2, '.', ',');
            $pdf->Cell(15, 5, 'Bs ' . $importe, 0, 1, 'L');
        }

        $pdf->Ln(); //Salto de linea

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(70, 5, 'Total Bs ' . number_format($datosVenta['total'], 2, '.', ','), 0, 1, 'R');

        $pdf->Ln(); //Salto de linea

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(70, 4, utf8_decode($ticketLeyenda), 0, 'C', 0);

        $pdf->Output("venta_pdf.pdf", "I");
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
