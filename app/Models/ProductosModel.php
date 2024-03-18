<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table      = 'producto';
    protected $primaryKey = 'cod_producto';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'codigo',
        'nombre_producto',
        'presentacion',
        'nombre_generico',
        'precio_compra',
        'precio_venta',
        'fecha_vencimiento',
        'stock',
        'stock_minimo',
        'inventariable',
        'id_categoria',
        'id_proveedor',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function actualizaStock($cod_producto, $cantidad, $operador = '+')
    {
        $this->set('stock', "stock $operador $cantidad", FALSE); //SET existencias 
        $this->where('cod_producto', $cod_producto);
        $this->update();
    }

    public function totalProductos()
    {
        return $this->where('activo', 1)->countAllResults(); //num_row
    }

    public function productosMinimo()
    {
        $where = "stock_minimo >= stock AND inventariable = 1 AND activo = 1";
        $this->where($where);
        $sql = $this->countAllResults();
        return $sql;
    }
    public function getProductosMinimo()
    {
        $where = "stock_minimo >= stock AND inventariable = 1 AND activo = 1";
        return $this->where($where)->findAll();
         
    }
    public function getProductoVencido(){
        $fecha = date("Y-m-d");
        $where = "inventariable = 1 AND activo = 1 AND '$fecha' > fecha_vencimiento";
        return $this->where($where)->findAll();
    }

    public function productosVencidos($fecha)
    {
        $where = "inventariable = 1 AND activo = 1  AND '$fecha' > fecha_vencimiento";
        $this->where($where);
        $sql = $this->countAllResults();
        return $sql;
    }
}
