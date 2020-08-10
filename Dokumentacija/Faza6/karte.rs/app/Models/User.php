<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'Korime';
    protected $allowedFields = ['KorIme', 'Ime', 'Prezime', 'Email', 'Sifra', 'Telefon', 'BRLK', 'Grad', 'Adresa', 'Drzava'];
    protected $returnType = 'object';
    
    
	
	/**
	* Funkcija koja dohvata korisnika po zadataom korisnickom imenu
	*
	* @param int $korime
	* @return object
	*
	*/
      public function uzmiKorisnika($korime) {
          
          $builder = $this->db->table('Ima_ulogu');
          $builder->select('*')
           ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left') 
           ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
           ->where('Korisnik.KorIme', $korime);
           $user = $builder->get()->getFirstRow();
           return $user;
            
      }
      
    /**
	* Funkcija koja dohvata sve korisnike i moderatore
	*
	* 
	* @return array
	*
	*/
      public function dohvatiKorisnikeiModetatore() {
          
          /*$this->db->select('*');
          $this->db->from('Ima_ulogu');
          $this->db->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left');
          $this->db->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left');
          $this->db->where('Uloga.Opis',"Korisnik");
          $this->db->orWhere("Uloga.Opis" , "Moderator");
          $query = $this->db->get();  
          return $query->result_array();*/
          
          $db= \Config\Database::connect();
          $builder = $db->table('Ima_ulogu');
          $builder->select('*')
          ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left')
          ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
          ->where('Uloga.Opis',"Korisnik")->orWhere("Uloga.Opis" , "Moderator");
          $uloga = $builder->get()->getResult();
          return $uloga;
          
          
          
      }
      
      
    /**
	* Funkcija koja dohvata sve korisnike i moderatore i vrsi njihovu paginacju po zadatom broju
	*
	* @param int $perPage koliko zelimo da prikazemo korisnika i moderatora po stranici
	* @param string $ime string po kome vrsimo pretragu korisnika, ako je taj parametar razlicit od null, ako je jednak null, onda prikazuje sve korisnike i moderatore.
	* @return array
	*
	*/
      public function paginateUsers(int $perPage, string $ime=null)
      {
          
          $pager = \Config\Services::pager(null, null, false);
          $page = $pager->getCurrentPage('default');
        
          
          $db= \Config\Database::connect();
          $builder = $db->table('Ima_ulogu');
          $builder->select('*')
          ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left')
          ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left');
        
          if($ime!=null){
            $builder->like('Korisnik.KorIme', $ime)
            ->where('Uloga.Opis',"Korisnik")->orWhere("Uloga.Opis" , "Moderator")->like('Korisnik.KorIme', $ime);
          }
          else
          {
              $builder->where('Uloga.Opis',"Korisnik")->orWhere("Uloga.Opis" , "Moderator");
          }
          
          $total = $builder->countAllResults(false);//$this->countAllResults(false);
          $this->pager = $pager->store('default', $page, $perPage, $total, 0);
          $offset      = ($page - 1) * $perPage;

          return $builder->get($perPage, $offset)->getResult();
          
          
          
          
          
          
          
          
          
      }
      
      
      /*
       public function paginate(int $perPage = null, string $group = 'default', int $page = 0, int $segment = 0)
	{
		$pager = \Config\Services::pager(null, null, false);
		$page  = $page >= 1 ? $page : $pager->getCurrentPage($group);

		$total = $this->countAllResults(false);

		// Store it in the Pager library so it can be
		// paginated in the views.
		$this->pager = $pager->store($group, $page, $perPage, $total, $segment);
		$perPage     = $this->pager->getPerPage($group);
		$offset      = ($page - 1) * $perPage;

		return $this->findAll($perPage, $offset);
	}
       */
      
      
      

}