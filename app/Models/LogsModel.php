<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
    protected $table      = 'logs';
    protected $primaryKey = 'id_logs';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_usuario',
        'evento',
        'ip',
        'detalles',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha';
    protected $updatedField  = '';
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

    public function obtener($activo = 1)
    {
        $this->select('logs.*, u.usuario AS cajero');
        $this->join('usuarios AS u', 'logs.id_usuario = u.id_usuario'); //INNER JOIN
        $this->where('logs.activo', $activo);
        $datos = $this->findAll();
        //print_r($this->getLastQuery());
        return $datos;
    }
}
