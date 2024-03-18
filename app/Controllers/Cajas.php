<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\ArqueoCajaModel;
use App\Models\VentasModel;

class Cajas extends BaseController
{
    protected $cajas, $session, $arqueoModel, $ventas;
    protected $reglas;

    public function __construct()
    {
        $this->cajas = new CajasModel();
        $this->arqueoModel = new ArqueoCajaModel();
        $this->ventas = new VentasModel();
        $this->session = session();
        helper(['form']);

        $this->reglas =
            [
                'numero_caja' =>
                [
                    'rules' => 'required|numeric|integer',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombre_caja' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'folio' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero.'
                    ]
                ]
            ];
    }

    public function index($activo = 1)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $Cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas', 'datos' => $Cajas];

        echo view('encabezado');
        echo view('Cajas/cajas_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $Cajas = $this->cajas->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Cajas eliminados', 'datos' => $Cajas];

        echo view('encabezado');
        echo view('Cajas/eliminadas_caja_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Agregar nueva caja'];

        echo view('encabezado');
        echo view('Cajas/nuevo_caja_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->cajas->save([
                'numero_caja' => $this->request->getPost('numero_caja'),
                'nombre_caja' => $this->request->getPost('nombre_caja'),
                'folio' => $this->request->getPost('folio')
            ]);
            return redirect()->to(base_url() . '/Cajas');
        } else {
            $data = ['titulo' => 'Agregar caja', 'validation' => $this->validator];

            echo view('encabezado');
            echo view('Cajas/nuevo_caja_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($id_caja, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $caja = $this->cajas->where('id_caja', $id_caja)->first();

        if ($valid !== null) {
            $data = [
                'titulo' => 'Editar caja', 'datos' => $caja,
                'validation' => $valid
            ];
        } else {
            $data = ['titulo' => 'Editar caja', 'datos' => $caja];
        }

        echo view('encabezado');
        echo view('cajas/editar_caja_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->cajas->update(
                $this->request->getPost('id_caja'),
                [
                    'numero_caja' => $this->request->getPost('numero_caja'),
                    'nombre_caja' => $this->request->getPost('nombre_caja'),
                    'folio' => $this->request->getPost('folio')
                ]
            );
            return redirect()->to(base_url() . '/Cajas');
        } else {
            return $this->editar(
                $this->request->getPost('id_caja'),
                $this->validator
            );
        }
    }

    public function borrar($id_caja) //eliminar
    {
        $this->cajas->update($id_caja, ['activo' => 0]);
        return redirect()->to(base_url() . '/Cajas');
    }

    public function reingresar($id_caja)
    {
        $this->cajas->update($id_caja, ['activo' => 1]);
        return redirect()->to(base_url() . '/Cajas');
    }

    public function arqueo($id_caja)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $arqueo = $this->arqueoModel->getDatos($id_caja);
        $data = ['titulo' => 'Cierre de caja', 'datos' => $arqueo];

        echo view('encabezado');
        echo view('cajas/arqueos', $data);
        echo view('pie_pagina');
    }

    public function nuevo_arqueo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        $existe = $this->arqueoModel->where(['id_caja' => $this->session->id_caja, 'estado' => 1])->countAllResults();

        if ($existe > 0) {
            echo 'La caja ya esta abierta';
            exit;
        }

        if ($this->request->getMethod() == "post") {

            $fecha = date('Y-m-d H:i:s');
            $existe = 0;
            $this->arqueoModel->save([
                'id_caja' => $this->session->id_caja,
                'id_usuario' => $this->session->id_usuario,
                'fecha_inicio' => $fecha,
                'monto_inicial' => $this->request->getPost('monto_inicial'),
                'estado' => 1
            ]);

            return redirect()->to(base_url() . '/cajas');
        } else {
            $caja = $this->cajas->where('id_caja', $this->session->id_caja)->first();
            $session = $this->session;
            $data = ['titulo' => 'Apertura de caja', 'caja' => $caja, 'session' => $session];
            echo view('encabezado');
            echo view('cajas/nuevo_arqueo', $data);
            echo view('pie_pagina');
        }
    }

    public function cerrar()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }

        if ($this->request->getMethod() == "post") {

            $fecha = date('Y-m-d H:i:s');

            $this->arqueoModel->update(
                $this->request->getPost('id_arqueo'),
                [
                    'fecha_fin' => $fecha,
                    'monto_final' => $this->request->getPost('monto_final'),
                    'monto_ventas' => $this->request->getPost('monto_ventas'),
                    'total_ventas' => $this->request->getPost('total_ventas'),
                    'estado' => 0
                ]
            );

            return redirect()->to(base_url() . '/cajas');
        } else {
            $date = date("Y-m-d");
            $totalVentas = $this->ventas->totalDia($date);
            $montoVentas = $this->ventas->totalVentas($date);

            $arqueo = $this->arqueoModel->where(['id_caja' => $this->session->id_caja, 'estado' => 1])->first();
            $caja = $this->cajas->where('id_caja', $this->session->id_caja)->first();
            $session = $this->session;
            $data = [
                'titulo' => 'Cerrar caja',
                'caja' => $caja,
                'session' => $session,
                'arqueo' => $arqueo,
                'totalVentas' => $totalVentas,
                'montoVentas' => $montoVentas
            ];
            echo view('encabezado');
            echo view('cajas/cerrar', $data);
            echo view('pie_pagina');
        }
    }

    function muestraCierreCaja($id_arqueo)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data['id_arqueo'] = $id_arqueo;
        echo view('encabezado');
        echo view('cajas/cierre_caja_pdf', $data);
        echo view('pie_pagina');
    }

    function generaCierreCajaPdf($id_arqueo)
    {
       
        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Cierre Caja");
        $pdf->SetFont('Arial', 'B', 16); //Arial, negrita, 10
        $pdf->Ln();

        $pdf->Image(base_url() . '/images/logotipo.png', 175, 10, 30, 20, 'PNG');

        $pdf->Ln(25);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, 'Detalle Cierre Caja', 1, 1, 'C', 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(25, 5, 'Caja', 1, 0, 'C');
        $pdf->Cell(26, 5, 'Usuario', 1, 0, 'C');
        $pdf->Cell(35, 5, 'Fecha Apertura', 1, 0, 'C');
        $pdf->Cell(35, 5, 'Fecha Cierre', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Monto Inicial', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Monto Final', 1, 0, 'C');
        $pdf->Cell(25, 5, 'Ventas', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 9);
        $detalleArqueo = $this->arqueoModel->select('*')->where('id_arqueo', $id_arqueo)->findAll();
        foreach ($detalleArqueo as $row) {
            
            $nombreUsuario = $this->session->nombre;
            
            $pdf->Cell(25, 5, $row['id_caja'], 1, 0, 'C');
            $pdf->Cell(26, 5, $nombreUsuario, 1, 0, 'C');
            $pdf->Cell(35, 5, $row['fecha_inicio'], 1, 0, 'C');
            $pdf->Cell(35, 5, $row['fecha_fin'], 1, 0, 'C');
            $pdf->Cell(25, 5, $row['monto_inicial'], 1, 0, 'C');
            $pdf->Cell(25, 5, $row['monto_final'], 1, 0, 'C');
            $pdf->Cell(25, 5, $row['total_ventas'], 1, 1, 'C');
        }

        $pdf->Output("cierre_caja.pdf", "I");
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output(); //Salida al navegador del pdf

    }
}
