<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionModel;

class Configuracion extends BaseController
{
    protected $configuracion, $session;
    protected $reglas;

    public function __construct()
    {
        $this->configuracion = new ConfiguracionModel();
        $this->session = session();
        helper(['form', 'upload']);

        $this->reglas =
            [
                'tienda_nombre' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'tienda_nit' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'tienda_telefono' =>
                [
                    'rules' => 'required|numeric',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'numeric' => 'El campo {field} debe ser un numero'
                    ]
                ],
                'tienda_direccion' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                    ]
                ],
                'tienda_email' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'ticket_leyenda' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];
    }

    public function index($activo = 1)
    {
        if(!isset($this->session->id_usuario)){
            return redirect()->to(base_url());
        }

        $nombre = $this->configuracion->where('nombre', 'tienda_nombre')->first();
        $nit = $this->configuracion->where('nombre', 'tienda_nit')->first();
        $telefono = $this->configuracion->where('nombre', 'tienda_telefono')->first();
        $direccion = $this->configuracion->where('nombre', 'tienda_direccion')->first();
        $email = $this->configuracion->where('nombre', 'tienda_email')->first();
        $leyenda = $this->configuracion->where('nombre', 'ticket_leyenda')->first();

        $data = [
            'titulo' => 'Configuración',
            'nombre' => $nombre,
            'nit' => $nit,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'email' => $email,
            'leyenda' => $leyenda
        ];

        echo view('encabezado');
        echo view('configuracion/configuracion_view', $data);
        echo view('pie_pagina');
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->configuracion->whereIn('nombre', ['tienda_nombre'])->set(['valor' =>
            $this->request->getPost('tienda_nombre')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_nit'])->set(['valor' =>
            $this->request->getPost('tienda_nit')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_telefono'])->set(['valor' =>
            $this->request->getPost('tienda_telefono')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_direccion'])->set(['valor' =>
            $this->request->getPost('tienda_direccion')])->update();

            $this->configuracion->whereIn('nombre', ['tienda_email'])->set(['valor' =>
            $this->request->getPost('tienda_email')])->update();

            $this->configuracion->whereIn('nombre', ['ticket_leyenda'])->set(['valor' =>
            $this->request->getPost('ticket_leyenda')])->update();

            $validacion = $this->validate([
                'tienda_logo' => [
                    'uploaded[tienda_logo]',
                    'mime_in[tienda_logo,image/png]',
                    'max_size[tienda_logo, 4096]'
                ]
            ]);

            if ($validacion) {
                $ruta_logo = "images/logotipo.png";
                if(file_exists($ruta_logo)){
                    unlink($ruta_logo);
                }
                $img = $this->request->getFile('tienda_logo');
                $img->move('./images', 'logotipo.png');
            } else {
                echo 'ERROR: en la validacion';
                exit;
            }

            return redirect()->to(base_url() . '/configuracion');
        } else {
        }
    }
}
