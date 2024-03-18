<?php

namespace App\Models;

use CodeIgniter\Model;

class ArqueoCajaModel extends Model
{
    protected $table      = 'arqueo_caja';
    protected $primaryKey = 'id_arqueo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_caja',
        'id_usuario',
        'fecha_inicio',
        'fecha_fin',
        'monto_inicial',
        'monto_final',
        'total_ventas',
        'estado'
    ];

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getDatos($id_caja){
        $this->select('arqueo_caja.*,caja.nombre_caja');
        $this->join('caja','arqueo_caja.id_caja = caja.id_caja');
        $this->where('arqueo_caja.id_caja' , $id_caja);
        $this->orderBy('arqueo_caja.id_caja', 'desc');
        $datos = $this->findAll();

        return $datos;
    }
}
