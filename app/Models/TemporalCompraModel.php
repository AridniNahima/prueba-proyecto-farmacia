<?php

namespace App\Models;

use CodeIgniter\Model;

class TemporalCompraModel extends Model
{
    protected $table      = 'temporal_compras';
    protected $primaryKey = 'id_temporal';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //retorna los datos como arreglos
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'folio',
        'cod_producto',
        'codigo',
        'nombre',
        'nombreg',
        'cantidad',
        'precio',
        'subtotal'       
    ];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function porIdProductoCompra($cod_producto, $folio)
    {
        $this->select('*');
        $this->where('folio', $folio);
        $this->where('cod_producto', $cod_producto);
        $datos = $this->get()->getRow();
        return $datos;
    }

    public function porCompra($folio)
    {
        $this->select('*');
        $this->where('folio', $folio);
        $datos = $this->findAll();//devuelve datos como arreglos
        //$datos = $this->get();//devuelve datos como propiedades
        return $datos;
    }

    public function actualizarProductoCompra($cod_producto, $folio, $cantidad, $subtotal)//actualiza la cantidad de compras de un producto x
    {
        $this->set('cantidad', $cantidad);
        $this->set('subtotal', $subtotal);
        $this->where('cod_producto', $cod_producto);
        $this->where('folio', $folio);
        $this->update();
    }
    public function eliminarProductoCompra($cod_producto, $folio)
    {
        $this->where('cod_producto', $cod_producto);
        $this->where('folio', $folio);
        $this->delete();
    }
    
    public function eliminarTemporalCompra($folio)
    {
        $this->where('folio', $folio);
        $this->delete();
    }
}
