<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogsModel;
use App\Models\UsuariosModel;

class Logs extends BaseController
{
    protected $Logs, $session, $usuario;
    protected $reglas;

    public function __construct()
    {
        $this->Logs = new LogsModel();
        $this->usuario = new UsuariosModel();
        $this->session = session();
        helper(['form']);
    }
    public function index($activo = 1)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        //$usuario = $this->usuario->getNombre($this->session->id_usuario);
        $datos = $this->Logs->obtener(1);
        $data = ['titulo' => 'Logs', 'datos' => $datos];

        echo view('encabezado');
        echo view('logs/logs_view', $data);
        echo view('pie_pagina');
    }
}
