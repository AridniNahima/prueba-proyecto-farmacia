<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'usuario',
        'nombre',
        'apellido',
        'password',
        'id_rol',
        'id_caja',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getNombre($id_usuario)
    {
        $usuario = $this->where('id_usuario', $id_usuario);
        return $usuario;
        echo $usuario;
         
    }
}
