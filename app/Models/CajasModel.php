<?php

namespace App\Models;

use CodeIgniter\Model;

class CajasModel extends Model
{
    protected $table      = 'caja';
    protected $primaryKey = 'id_caja';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'numero_caja',
        'nombre_caja',
        'folio',
        'activo'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
