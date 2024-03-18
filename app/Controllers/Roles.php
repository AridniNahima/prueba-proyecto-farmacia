<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\DetalleRolesPermisosModel;

class Roles extends BaseController
{
    protected $roles, $session, $permisos, $detalleRoles;
    protected $reglas;

    public function __construct()
    {
        $this->roles = new RolesModel();
        $this->permisos = new PermisosModel();
        $this->detalleRoles = new DetalleRolesPermisosModel();
        $this->session = session();
        helper(['form']);

        $this->reglas =
            [
                'nombre_rol' =>
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
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Roles', 'datos' => $roles];

        echo view('encabezado');
        echo view('roles/roles_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Roles eliminadas', 'datos' => $roles];

        echo view('encabezado');
        echo view('roles/eliminadas_rol_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $data = ['titulo' => 'Agregar rol'];

        echo view('encabezado');
        echo view('roles/nuevo_rol_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->roles->save(
                [
                    'nombre_rol' => $this->request->getPost('nombre_rol')
                ]
            );
            return redirect()->to(base_url() . '/roles');
        } else {
            $data = ['titulo' => 'Agregar rol', 'validation' => $this->validator];

            echo view('encabezado');
            echo view('roles/nuevo_rol_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($id_rol, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $rol = $this->roles->where('id_rol', $id_rol)->first();

        if ($valid !== null) {
            $data = ['titulo' => 'Editar rol', 'datos' => $rol, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar rol', 'datos' => $rol];
        }

        echo view('encabezado');
        echo view('roles/editar_rol_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {

            $this->roles->update(
                $this->request->getPost('id_rol'),
                ['nombre_rol' => $this->request->getPost('nombre_rol')]
            );
            return redirect()->to(base_url() . '/roles');
        } else {
            return $this->editar(
                $this->request->getPost('id_rol'),
                $this->validator
            );
        }
    }

    public function borrar($id_rol)
    {
        $this->roles->update($id_rol, ['activo' => 0]);
        return redirect()->to(base_url() . '/roles');
    }

    public function reingresar($id_rol)
    {
        $this->roles->update($id_rol, ['activo' => 1]);
        return redirect()->to(base_url() . '/roles');
    }

    public function detalles($id_rol)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $permisos = $this->permisos->findAll();
        $permisosAsignados = $this->detalleRoles->where('id_rol', $id_rol)->findAll();
        $datos = array();

        
        
        foreach ($permisosAsignados as $permisosAsignado) {
            $datos[$permisosAsignado['id_permiso']] = true;
        }

        $data = ['titulo' => 'Asignar Permisos', 'permisos' => $permisos, 'id_rol' => $id_rol, 'asignado' => $datos];

        echo view('encabezado');
        echo view('roles/detalles_rol', $data);
        echo view('pie_pagina');
    }

    public function guardaPermisos()
    {
        if ($this->request->getMethod() == "post") {
            $id_rol = $this->request->getPost('id_rol');
            $permisos = $this->request->getPost('permisos');

            $this->detalleRoles->where('id_rol', $id_rol)->delete();

            foreach ($permisos as $permiso) {
                $this->detalleRoles->save(['id_rol' => $id_rol, 'id_permiso' => $permiso]);
            }
            return redirect()->to(base_url() . '/roles');
        }
    }
}
