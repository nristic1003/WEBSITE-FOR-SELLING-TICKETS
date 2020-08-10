<?php namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    protected $table      = 'ima_ulogu';
    protected $primaryKey = 'KorIme';
    protected $allowedFields = ['KorIme', 'IdU'];
    protected $returnType = 'object';

}