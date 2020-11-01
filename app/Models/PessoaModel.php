<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class PessoaModel extends Model
{
    protected $table = 'pessoas';
    protected $primaryKey = 'id';

    protected $returnType = "array";
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id','nome', 'altura', 'lactose', 'peso', 'atleta'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
  

}