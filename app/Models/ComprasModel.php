<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{
    protected $table      = 'compra';
    protected $primaryKey = 'id_compra';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'folio',
        'total',
        'id_usuario',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertaCompra($id_compra, $total, $id_usuario)
    {
        $this->insert([
            'folio' => $id_compra,
            'total' => $total,
            'id_usuario' => $id_usuario
        ]);
        return $this->insertID();
    }

    public function totalDia($fecha)
    {
        $where = "activo = 1 AND DATE(fecha_alta) = '$fecha'";
        return $this->where($where)->countAllResults();
    }
    public function totalCompras($fecha)
    {
        $this->select("sum(total) AS total");
        $where = "activo = 1 AND DATE(fecha_alta) = '$fecha'";
        return $this->where($where)->first();
    }
}
