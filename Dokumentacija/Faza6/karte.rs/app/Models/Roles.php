<?php namespace App\Models;

use CodeIgniter\Model;

class Roles extends Model
{
    protected $table      = 'uloga';
    protected $primaryKey = 'Idu';
    protected $allowedFields = ['Idu', 'Opis'];
    protected $returnType = 'object';

}