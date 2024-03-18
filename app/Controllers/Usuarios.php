<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\RolesModel;
use App\Models\CajasModel;
use App\Models\LogsModel;

class Usuarios extends BaseController
{
    protected $usuarios, $roles, $cajas, $session, $log;
    protected $reglas, $reglasLogin, $reglasCambia, $reglasEditar;

    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
        $this->roles = new RolesModel();
        $this->cajas = new CajasModel();
        $this->log = new LogsModel();
        $this->session = session();
        helper(['form']);

        $this->reglas =
            [
                'usuario' =>
                [
                    'rules' => 'required|is_unique[usuarios.usuario]',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'is_unique' => 'El campo {field} debe ser unico.'
                    ]
                ],
                'nombre' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'apellido' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'password' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'repassword' =>
                [
                    'rules' => 'required|matches[password]',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'matches' => 'Las contraseñas no coinciden.'
                    ]
                ],
                'id_caja' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],

                'id_rol' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];

        $this->reglasLogin =
            [
                'usuario' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'password' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];
        $this->reglasCambia =
            [
                'password' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],

                'repassword' =>
                [
                    'rules' => 'required|matches[password]',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        'matches' => 'Las contraseñas no coinciden'
                    ]
                ],
            ];

        $this->reglasEditar =
            [
                'usuario' =>
                [
                    'rules' => 'required|is_unique[usuarios.usuario]',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.',
                        
                    ]
                ],
                'nombre' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'apellido' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],

                'id_caja' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],

                'id_rol' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ]
            ];

        $this->reglasLogin =
            [
                'usuario' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'password' =>
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
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios', 'datos' => $usuarios];

        echo view('encabezado');
        echo view('usuarios/usuarios_view', $data);
        echo view('pie_pagina');
    }

    public function eliminados($activo = 0)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $usuarios = $this->usuarios->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Usuarios eliminadas', 'datos' => $usuarios];

        echo view('encabezado');
        echo view('usuarios/eliminadas_usuario_view', $data);
        echo view('pie_pagina');
    }

    public function nuevo()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data = ['titulo' => 'Agregar usuario', 'cajas' => $cajas, 'roles' => $roles,];

        echo view('encabezado');
        echo view('usuarios/nuevo_usuario_view', $data);
        echo view('pie_pagina');
    }

    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            //cifrado de contraseña
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->usuarios->save(
                [
                    'usuario' => $this->request->getPost('usuario'),
                    'password' => $hash,
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'id_caja' => $this->request->getPost('id_caja'),
                    'id_rol' => $this->request->getPost('id_rol'),
                    'activo' => 1
                ]
            );
            return redirect()->to(base_url() . '/usuarios');
        } else {
            $roles = $this->roles->where('activo', 1)->findAll();
            $cajas = $this->cajas->where('activo', 1)->findAll();
            $data = [
                'titulo' => 'Agregar usuario',
                'roles' => $roles,
                'cajas' => $cajas,
                'validation' => $this->validator
            ];

            echo view('encabezado');
            echo view('usuarios/nuevo_usuario_view', $data);
            echo view('pie_pagina');
        }
    }

    public function editar($id_usuario, $valid = null)
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
        $roles = $this->roles->where('activo', 1)->findAll();
        $cajas = $this->cajas->where('activo', 1)->findAll();
        $usuario = $this->usuarios->where('id_usuario', $id_usuario)->first();

        if ($valid !== null) {
            $data = [
                'titulo' => 'Editar usuario',
                'cajas' => $cajas,
                'roles' => $roles,
                'datos' => $usuario,
                'validation' => $valid
            ];
        } else {
            $data = [
                'titulo' => 'Editar usuario',
                'cajas' => $cajas,
                'roles' => $roles,
                'datos' => $usuario,
                'validation' => $valid
            ];
        }

        echo view('encabezado');
        echo view('usuarios/editar_usuario_view', $data);
        echo view('pie_pagina');
    }

    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasEditar)) {

            $this->usuarios->update(
                $this->request->getPost('id_usuario'),
                [
                    'usuario' => $this->request->getPost('usuario'),
                    'nombre' => $this->request->getPost('nombre'),
                    'apellido' => $this->request->getPost('apellido'),
                    'id_rol' => $this->request->getPost('id_rol'),
                    'id_caja' => $this->request->getPost('id_caja')
                ]
            );
            return redirect()->to(base_url() . '/usuarios');
        } else {
            return $this->editar(
                $this->request->getPost('id_usuario'),
                $this->validator
            );
        }
    }

    public function borrar($id_usuario)
    {
        $this->usuarios->update($id_usuario, ['activo' => 0]);
        return redirect()->to(base_url() . '/usuarios');
    }

    public function reingresar($id_usuario)
    {
        $this->usuarios->update($id_usuario, ['activo' => 1]);
        return redirect()->to(base_url() . '/usuarios');
    }
    public function login()
    {
        echo view('login');
    }
    public function valida()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasLogin)) {
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $datosUsuario = $this->usuarios->where('usuario', $usuario)->first();

            if ($datosUsuario != null) {
                if (password_verify($password, $datosUsuario['password'])) { //verifica  la contraseña
                    $datosSession = [
                        'id_usuario' => $datosUsuario['id_usuario'],
                        'nombre' => $datosUsuario['nombre'],
                        'apellido' => $datosUsuario['apellido'],
                        'id_rol' => $datosUsuario['id_rol'],
                        'id_caja' => $datosUsuario['id_caja']
                    ];

                    $ip = $_SERVER['REMOTE_ADDR'];
                    $detalles = $_SERVER['HTTP_USER_AGENT'];

                    $this->log->save([
                        'id_usuario' => $datosUsuario['id_usuario'],
                        'evento' => 'INICIO DE SESIÓN',
                        'ip' => $ip,
                        'detalles' => $detalles
                    ]);

                    //$session = session();
                    $this->session->set($datosSession);
                    return redirect()->to(base_url() . '/inicio');
                } else {
                    $data['error'] = "La contraseña no coincide";
                    echo view('login', $data);
                }
            } else {
                $data['error'] = "El usuario no existe";
                echo view('login', $data);
            }
        } else {
            $data = ['validation' => $this->validator];
            echo view('login', $data);
        }
    }
    public function logout()
    {
        //$session = session();

        $ip = $_SERVER['REMOTE_ADDR'];
        $detalles = $_SERVER['HTTP_USER_AGENT'];

        $this->log->save([
            'id_usuario' => $this->session->id_usuario,
            'evento' => 'CIERRE DE SESIÓN',
            'ip' => $ip,
            'detalles' => $detalles
        ]);

        $this->session->destroy();
        return redirect()->to(base_url());
    }

    public function cambia_password()
    {
        if (!isset($this->session->id_usuario)) {
            return redirect()->to(base_url());
        }
       
        $usuario = $this->usuarios->where('id_usuario', $this->session->id_usuario)->first();
        $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario];

        echo view('encabezado');
        echo view('usuarios/cambia_password', $data);
        echo view('pie_pagina');
    }

    public function actualizar_password()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglasCambia)) {

            $idUsuario = $this->session->id_usuario;
            $hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $this->usuarios->update(
                $idUsuario,
                [
                    'password' => $hash,
                ]
            );

            $usuario = $this->usuarios->where('id_usuario', $this->session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña actualizada'];

            echo view('encabezado');
            echo view('usuarios/cambia_password', $data);
            echo view('pie_pagina');
        } else {
            $usuario = $this->usuarios->where('id_usuario', $this->session->id_usuario)->first();
            $data = ['titulo' => 'Cambiar contraseña', 'usuario' => $usuario, 'validation' => $this->validator];

            echo view('encabezado');
            echo view('usuarios/cambia_password', $data);
            echo view('pie_pagina');
        }
    }
}
