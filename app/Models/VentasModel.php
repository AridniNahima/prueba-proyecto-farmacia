<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table      = 'venta';
    protected $primaryKey = 'id_venta';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'folio',
        'total',
        'id_usuario',
        'id_caja',
        'forma_pago',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertaVenta($id_venta, $total, $id_usuario, $id_caja, $forma_pago)
    {
        $this->insert([
            'folio' => $id_venta,
            'total' => $total,
            'id_usuario' => $id_usuario,
            'id_caja' => $id_caja,
            'forma_pago' => $forma_pago
        ]);
        return $this->insertID();
    }
    public function obtener($activo = 1)
    {
        $this->select('venta.*, u.usuario AS cajero, c.nombre_caja AS caja  ');
        $this->join('usuarios AS u', 'venta.id_usuario = u.id_usuario'); //INNER JOIN
        $this->join('caja AS c', 'venta.id_caja = c.id_caja'); //INNER JOIN
        //$this->join('configuracion AS conf', 'ventas.forma_pago = conf.');//INNER JOIN
        $this->where('venta.activo', $activo);
        $this->orderBy('venta.fecha_alta', 'ASC');
        $datos = $this->findAll();
        //print_r($this->getLastQuery());
        return $datos;
    }

    public function totalDia($fecha)
    {
        $where = "activo = 1 AND DATE(fecha_alta) = '$fecha'";
        return $this->where($where)->countAllResults();
    }
    public function totalVentas($fecha)
    {
        $this->select("sum(total) AS total");
        $where = "activo = 1 AND DATE(fecha_alta) = '$fecha'";
        return $this->where($where)->first();
    }
}
