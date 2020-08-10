<?php namespace App\Models;

use CodeIgniter\Model;

class Transakcija extends Model
{
    protected $table      = 'transakcija';
    protected $primaryKey = 'IdT';
    protected $returnType = 'object';
    protected $allowedFields = ['IdD', 'Cena', 'BrojKartice', 'Ishod', 'KorIme'];
}