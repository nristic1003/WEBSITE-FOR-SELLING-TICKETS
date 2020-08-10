<?php namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
    protected $table      = 'dogadjaj';
    protected $primaryKey = 'IdD';
    protected $returnType = 'object';
    
     protected $allowedFields = ['IdD', 'Naziv', 'Cena', 'Datum', 'Lokacija', 'Slika', 'Tip', 'Opis', 'BrojKarata', 'KorIme', 'Odobrio', 'Status', 'Telefon'];


   /* public function pretraga($tekst) {
        return $this->where('Tip','M')->like('Naziv', $tekst)
            ->orLike('Opis', $tekst)->findAll();
    }
    */
     
     /**
      * Funkcija koja prima niz id-jeva i vraca odgovarajuce manifestacije
      * @param arrya[int $iddog]
      * @return array      /
      */
    public function findid($iddog) {
        return $this->whereIn('idD', $iddog)->findAll();
    }
    
	  /**
      * Funkcija koja pretrazuje oglase po zadatom imenu i vrsi njihovu paginaciju
      * @param int $perPage koliko zelimo da prikazemo manifestacije po stranici
	  * @param string $ime string po kome vrsimo pretragu manifestacija
      * @return array      /
      */
	public function pretraga(int $perPage, string $ime="")
      {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
            $query = $this->where('Tip','M')->like('Naziv', $ime)
            ->orLike('Opis', $ime)->where('Tip','M');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->findAll($perPage, $offset);
          
      }
      
       /**
      * Funkcija koja dohvata sve oglase iz baze i vrsi njihovu paginaciju
      * @param int $perPage koliko zelimo da prikazemo oglasa po stranici
      * @return array      /
      */
      public function svioglasi(int $perPage) {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
          $query = $this->where('Tip','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->orderBy('Status','DESC')->findAll($perPage, $offset);       
      }
      
      
      /**
      * Funkcija koja dohvata sve aktivne oglase iz baze i vrsi njihovu paginaciju
      * @param int $perPage koliko zelimo da prikazemo oglasa po stranici
      * @return array      /
      */
      public function oglasi(int $perPage) {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
          $query = $this->where('Tip','O')->where('Status','A');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->orderBy('Status','DESC')->findAll($perPage, $offset);       
      }
      
	  /**
      * Funkcija koja dohvata sve manifestacije iz baze i vrsi njihovu paginaciju
      * @param int $perPage koliko zelimo da prikazemo manifestacije po stranici
      * @return array      /
      */
        public function manifestacije(int $perPage) {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
          $query = $this->where('Tip','M');//->where('Status','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->findAll($perPage, $offset);       
      }
      
	  
  /**
      * Funkcija koja pretrazuje oglase po zadatom imenu i vrsi njihovu paginaciju
      * @param int $perPage koliko zelimo da prikazemo oglasa po stranici
	  * @param string $ime string po kome vrsimo pretragu oglasa
      * @return array      /
      */
      public function pretragaOglasa(int $perPage, string $ime="")
      {
          
           $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
          
            $query = $this->where('Tip','O')->like('Naziv', $ime)
                    ->orLike('Opis', $ime)->where('Tip','O');
          
          
          $total = $query->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset = ($page - 1) * $perPage;
          
          return $query->orderBy('Status','DESC')->findAll($perPage, $offset);
  
      }
      
    
}