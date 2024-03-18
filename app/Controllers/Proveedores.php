<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProveedoresModel;

class Proveedores extends BaseController
{
    protected $proveedores, $session;
    protected $reglas;

    public function __construct()
    {
        $this->proveedores = new ProveedoresModel();
        $this->session = session();
        helper(['form']);

        $this->reglas =
            [
                'nit' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombre_proveedor' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'telefono' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'celular' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero.'
                    ]
                ],
            ];
    }

    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }
        $proveedores = $this->proveedores->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Laboratorios', 'datos' => $proveedores];

        echo view('encabezado');
        echo view('proveedores/proveedores_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $proveedores = $this->proveedores->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Laboratorios eliminados', 'datos' => $proveedores];

        echo view('encabezado');
        echo view('proveedores/eliminadas_proveedor_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Nuevo laboratorio'];

        echo view('encabezado');
        echo view('proveedores/nuevo_proveedor_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->proveedores->save([
                'nit' => $this->request->getPost('nit'),
                'nombre_proveedor' => $this->request->getPost('nombre_proveedor'),
                'telefono' => $this->request->getPost('telefono'),
                'celular' => $this->request->getPost('celular')
            ]);
            return redirect()->to(base_url() . '/proveedores');
        } else {
            $data = ['titulo' => 'Agregar laboratorio', 'validation' => $this->validator];

            echo view('encabezado');
            echo view('proveedores/nuevo_proveedor_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($id_proveedor, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $proveedor = $this->proveedores->where('id_proveedor', $id_proveedor)->first();

        if ($valid !== null) {
            $data = [
                'titulo' => 'Editar proveedor', 'datos' => $proveedor,
                'validation' => $valid
            ];
        } else {
            $data = ['titulo' => 'Editar proveedor', 'datos' => $proveedor];
        }

        echo view('encabezado');
        echo view('proveedores/editar_proveedor_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->proveedores->update(
                $this->request->getPost('id_proveedor'),
                [
                    'nit' => $this->request->getPost('nit'),
                    'nombre_proveedor' => $this->request->getPost('nombre_proveedor'),
                    'telefono' => $this->request->getPost('telefono'),
                    'celular' => $this->request->getPost('celular')
                ]
            );
            return redirect()->to(base_url() . '/proveedores');
        } else {
            return $this->editar(
                $this->request->getPost('id_proveedor'),
                $this->validator
            );
        }
    }

    public function borrar($id_proveedor)
    {
        $this->proveedores->update($id_proveedor, ['activo' => 0]);
        return redirect()->to(base_url() . '/proveedores');
    }

    public function reingresar($id_proveedor)
    {
        $this->proveedores->update($id_proveedor, ['activo' => 1]);
        return redirect()->to(base_url() . '/proveedores');
    }
}
