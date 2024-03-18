<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedoresModel extends Model
{
    protected $table      = 'proveedor';
    protected $primaryKey = 'id_proveedor';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nit',
        'nombre_proveedor',
        'telefono', 
        'celular',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function totalProveedores()
    {
        return $this->where('activo', 1)->countAllResults(); //num_row
    }
}
