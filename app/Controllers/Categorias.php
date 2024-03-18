<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    protected $categorias, $session;
    protected $reglas;

    public function __construct()
    {
        $this->categorias = new CategoriasModel();
        $this->session = session();
        helper(['form']);

        $this->reglas =
            [
                'nombre_categoria' =>
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

        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorías', 'datos' => $categorias];

        echo view('encabezado');
        echo view('categorias/categorias_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorías eliminadas', 'datos' => $categorias];

        echo view('encabezado');
        echo view('categorias/eliminadas_categoria_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Agregar categoría'];

        echo view('encabezado');
        echo view('categorias/nuevo_categoria_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->categorias->save(
                [
                    'nombre_categoria' => $this->request->getPost('nombre_categoria')
                ]
            );
            return redirect()->to(base_url() . '/categorias');
        } else {
            $data = ['titulo' => 'Agregar categoría', 'validation' => $this->validator];

            echo view('encabezado');
            echo view('categorias/nuevo_categoria_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($id_categoria, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $categoria = $this->categorias->where('id_categoria', $id_categoria)->first();

        if ($valid !== null) {
            $data = ['titulo' => 'Editar categoria', 'datos' => $categoria, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar categoria', 'datos' => $categoria];
        }

        echo view('encabezado');
        echo view('categorias/editar_categoria_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->categorias->update(
                $this->request->getPost('id_categoria'),
                ['nombre_categoria' => $this->request->getPost('nombre_categoria')]
            );
            return redirect()->to(base_url() . '/categorias');
        } else {
            return $this->editar(
                $this->request->getPost('id_categoria'),
                $this->validator
            );
        }
    }

    public function borrar($id_categoria)
    {
        $this->categorias->update($id_categoria, ['activo' => 0]);
        return redirect()->to(base_url() . '/categorias');
    }

    public function reingresar($id_categoria)
    {
        $this->categorias->update($id_categoria, ['activo' => 1]);
        return redirect()->to(base_url() . '/categorias');
    }
}
