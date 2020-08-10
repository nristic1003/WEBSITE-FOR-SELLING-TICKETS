<?php namespace App\Models;

use CodeIgniter\Model;

class Stavka extends Model
{
    protected $table      = 'stavka';
    protected $primaryKey = 'IdS';
    protected $returnType = 'object';
    protected $allowedFields = ['IdD', 'Cena', 'IdT', 'Kolicina'];
}