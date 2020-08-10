<?php namespace App\Controllers;
use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Roles;
use App\Models\Transakcija;
use App\Models\Stavka;


/**
* Korisnik – klasa koja predstavlja ulogu korisnika
*
* @version 1.0
*/
class Korisnik extends BaseController
{
    
    /**
	* Funkcija koju ostale funkcije pozivaju zbog ucitavanja odgovarajuce stranice
	*
	* @param String $page
	* @param String[] $data
	* @return void
	*/
    protected function prikaz($page, $data)
    {
      $data['controller']='Korisnik';
      $data['user']=$this->session->get('user');
      echo view('Prototip/header_kor', $data);
      echo view("Prototip/$page", $data);
      echo view("Prototip/footer", $data);

    }
    
	/**
	* Funkcija koja se poziva kada korisnik zeli da izbrise svoj nalog. Ukoliko se lozinke koje je korisnik uneo poklapaju sa stvarnom lozinkom
	* korisnika, njegov nalog se brise i on se automatski logoutuje :D
	*
	* @param string $lozinka1
	* @param string $lozinka2
	* @return void
	*/
    public function izbrisiKorisnika($lozinka1, $lozinka2) {
        
        if($lozinka1==$lozinka2 && md5($lozinka1)==$this->session->get('user')->Sifra){
        
        $role = new Role();
        $user = new User();
        $news = new News();
        $korime = $this->session->get('user')->KorIme;
       
            $role->where("KorIme", $korime)->delete();
            $news->where("KorIme", $korime)->delete();
           /**/ /*$role*/$user->where("KorIme", $korime)->delete();
           //Brisanje transakcija korisnika ili setovanje NULL-ova u bazi :D
           $this->session->destroy();
            return redirect()->to(site_url('/'));
        }
        else 
        {
           return redirect()->to(site_url($this->session->get('user')->Opis.'/userInfo')); 
        }
    }
	/**
	* Funkcija koju kontoler poziva za ucitavanje logout stranice 
	*
	* @return void
 	*/
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    
   /* public function userInfo()
    {
        $newsDB = new News();
        $korime = $this->session->get('user')->KorIme;
        $news = $newsDB->where('KorIme',$korime)->findAll();
        $this->method='userInfo';
        
        $this->prikaz('user',['method'=>$this->method, 'news'=>$news, 'uloga'=>$this->session->get('user')->Opis]);
    
    }*/
    
	
	/**
	* Funkcija koju kontoler poziva za ucitavanje stranice za prikaz informacija o korisniku 
	*
	* @return void
 	*/
       public function userInfo()
    {
        $newsDB = new News();
        $korime = $this->session->get('user')->KorIme;
        $news = $newsDB->where('korime',$korime)->findAll();
        $this->method='userInfo';

        $db= \Config\Database::connect();
        $builder = $db->table('Ima_ulogu');
        $builder->select('*')
            ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left')
            ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
            ->where('Korisnik.KorIme',$korime);
        $uloga = $builder->get();


        $this->prikaz('user',['method'=>$this->method, 'news'=>$news, 'uloga'=>$uloga->getFirstRow()]);

    }
    
	
	/**
	* Funkcija koju korisnik poziva za uklanjanje oglasa koji je prethodno objavio 
	* @param int $idOglas sluzi za identifikaciju oglasa koji brisemo
	* @return void
 	*/
    public function ukloniOglas($idOglas)
    {
            $korime = $this->session->get('user')->KorIme;
            $newsDB = new News();
            $newsDB->where('IdD',$idOglas)->where('KorIme',$korime)->delete();
            return redirect()->to(site_url($this->session->get('user')->Opis.'/userInfo'));
                   
        
    }
    
	/**
	* Funkcija koja otvara stranicu gde korisnik moze da menja svoje informacije (sve osim Korisnickog imena)
	*
	* @return void
 	*/
    public function urediProfil()
    {
        
        $naslov = 'Uredi profil';
        $this->method = 'userInfo';
        $poruka = '';
        $this->prikaz("forma", ['poruka'=>$poruka, 'method'=>$this->method, 'naslov'=>$naslov, 'korisnik'=>$this->session->get('user')]);
                     
    }
    
	
	/**
	* Funkcija koja prikuplja podatke sa stranice za editrovanje informacija o korisniku, vrsi njihovu validaciju.
	* Ukoliko korisnik nije popunio polje "Stara sifra" ili "Nova Sifra" azurirace se podaci ostalih polja u bazi. Ukoliko zeli da promeni sifru, mora
	* da unese staru i novu sifru.
	* @return void
 	*/
    public function azurirajProfil()
    {
        $nil = null;
        $this->method = 'userInfo';
        $userDB = new User();

        if(!$this->validate(
            ['ime'=>'required|min_length[1]|max_length[20]',
            'prezime'=>'required|min_length[1]|max_length[20]',
            //'korime'=>'trim|required|min_length[1]|max_length[15]',
            'email'=>'trim|required|min_length[1]|max_length[50]',
            'telefon'=>'required|min_length[1]|max_length[15]',
            'brlk'=>'required|min_length[1]|max_length[9]',
            'grad'=>'required|min_length[1]|max_length[15]',
            'adresa'=>'required|min_length[1]|max_length[30]',
            'drzava' => 'required'
            ]
        )

        ) return $this->prikaz('forma', ['naslov'=>'Uredi profil' ,'errors'=>$this->validator->listErrors() ,'method'=>$this->method, 'korisnik'=>$this->session->get('user')]);
        
            $korisnik=null;
            
            
            
            
            if($this->request->getVar("email")!=$this->session->get('user')->Email)
                $korisnik = $userDB->where('Email', $this->request->getVar("email"))->find();
            
            if($korisnik==null && md5($this->request->getVar("lozinka"))==$this->session->get('user')->Sifra && $this->request->getVar("ponlozinka")!=null){
                $userDB->where('KorIme', $this->session->get('user')->KorIme);
                
                $userDB->set(
                [
                    'Ime'=>$this->request->getVar("ime"),
                    'Prezime'=>$this->request->getVar("prezime"),
                    //'KorIme'=>$this->request->getVar("korime"),
                    'Email'=>$this->request->getVar("email"),
                    'Sifra'=>md5($this->request->getVar("ponlozinka")),
                    'Telefon'=>$this->request->getVar("telefon"),
                    //'JMBG'=>$this->request->getVar("jmbg"),
                    'BRLK'=>$this->request->getVar("brlk"),
                    'Grad'=>$this->request->getVar("grad"),
                    'Adresa'=>$this->request->getVar("adresa"),
                    'Drzava' => $this->request->getVar("drzava")
                ]
                );
                 $userDB->update();
                 return $this->logout();
            }
            else if($korisnik==null && $this->request->getVar("lozinka")==null && $this->request->getVar("ponlozinka")==null)
            {
                $userDB->where('KorIme', $this->session->get('user')->KorIme);
                
                $userDB->set(
                [
                    'Ime'=>$this->request->getVar("ime"),
                    'Prezime'=>$this->request->getVar("prezime"),
                    'Email'=>$this->request->getVar("email"),
                    'Telefon'=>$this->request->getVar("telefon"),
                    'BRLK'=>$this->request->getVar("brlk"),
                    'Grad'=>$this->request->getVar("grad"),
                    'Adresa'=>$this->request->getVar("adresa"),
                    'Drzava' => $this->request->getVar("drzava"),
                ]
                );
                 $userDB->update();
                 
                 
                 /*$db= \Config\Database::connect();
                 $builder = $db->table('Ima_ulogu');
                 $builder->select('*')
                 ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left') 
                 ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
                 ->where('Korisnik.KorIme', $this->session->get('user')->KorIme);
                 $user = $builder->get()->getFirstRow();
                 $this->session->set('user', $user);*/
                 
                 $this->session->set('user', $userDB->uzmiKorisnika($this->session->get('user')->KorIme));
                 return $this->userInfo();
                
            }
            else
            {
                 $this->method = 'userInfo';
                 if($korisnik!=null)
                     $poruka = "<font color='red' size='5px'>Email je zauzet!</font>";
                 else if($this->request->getVar("lozinka")!=$this->session->get('user')->Sifra)
                     $poruka = "<font color='red' size='5px'>Pogrešna stara šifra!</font><br>";
                 else
                     $poruka = "<font color='red' size='5px'>Morate uneti novu šifru!</font><br>";
                 return $this->prikaz('forma', ['method'=>$this->method, 'naslov'=>'Uredi profil', 'korisnik'=>$this->session->get('user'), 'poruka'=>$poruka]);
            }
        }
		
	/**
	* Funkcija koja otvara stranicu za objavljivanje oglasa.
	* @return void
 	*/
        
    public function objaviOglas()
    {
        $naslov = 'Objavljivanje oglasa';
        $this->method='oglasi';
        $news = null;
        $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov , 'opis'=>$this->session->get('user')->Opis]);
          
    }
    
	/**
	* Funkcija koja otvara stranicu za editovanje oglasa.
	* @param int $idOglas Sluzi za identifikaciju oglasa koji zelimo da editujemo
	* @return void
 	*/
        
    public function izmeniOglas($idOglas)    //Moderator i Admin mogu da edituju i brisu sve oglase
    {

        $naslov = 'Izmena oglasa';
        $korime = $this->session->get('user')->KorIme;

            $newsDB = new News();
            $news = $newsDB->where('KorIme',$korime)->where('IdD',$idOglas)->find();
            if($news!=null)
            {
                $this->method='userInfo';
                $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov, 'opis'=>$this->session->get('user')->Opis]);
            }
            else
            {
                return redirect()->to(site_url($this->session->get('user')->Opis.'/userInfo'));
            }        
        
    }
    
    /**
	* Funkcija koja uzima podatke sa stranice za objavljvianje oglasa i validira ih. Ukoliko je validacija uspesna oglas se upisuje u bazu, pod statusom da nije odobren i korisnik se vraca
	* na stranicu gde moze da pogleda njegove objavljene oglase.
	* Odobrenje vrsi moderator ili admin i tek tad oglas mogu da vide ostli korisnici.
	* @return void
 	*/    
    public function ubaciOglas()
    {
        
            $this->method='dodajOglas';
            $news = null;
            $naslov = 'Objavljivanje oglasa';
        
            if(!$this->validate(
            ['naziv'=>'required',
            'cena'=>'required',
            'datum'=>'required',
            'lokacija'=>'required',
            'vreme'=>'required',
            'brojkarata'=>'required',
            'telefon' => 'required'
            ]
        ))
       return $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);
            
           if($_FILES['slika']['tmp_name']!="") 
            $slika = file_get_contents($_FILES['slika']['tmp_name']);
        else {
            return $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);
        }
           $date = $this->request->getVar("datum") ." ". $this->request->getVar("vreme");
           $date = date_create($date);
           $date = date_format($date, 'Y-m-d H:i:s');
           
  
            $news = new News();   
             $news->insert(
                [
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Slika'=> $slika,
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>"N",
                    'Telefon' => $this->request->getVar("telefon"),
                ]
                );
             
             
             
             
             return redirect()->to(site_url($this->session->get('user')->Opis.'/userInfo'));
           
             
        }
    
	/**
	* Funkcija koja uzima podatke sa stranice za editovanje oglasa i validira ih. Ukoliko je validacija uspesna oglas se update-uje u bazi.
	* Ukoliko validacija nije uspesna, korisnik dobija biva obavesen koja polja je lose uneo.
	* @param int $IdD Sluzi za identifikaciju oglasa koji zelimo da editujemo
	* @return void
 	*/   
    public function azurirajOglas($IdD) 
    {

        
        
        $news = new News();
        $date = $this->request->getVar("datum") ." ". $this->request->getVar("vreme");
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        
        if($_FILES['slika']['tmp_name']!=null)
        {
            $slika = file_get_contents($_FILES['slika']['tmp_name']);  
            $news->where('IdD',$IdD);
            $news->set(
                [
                    
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Slika' => $slika,
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>"N",
                    'Telefon'=> $this->request->getVar("telefon"),
                ]
            );
            $news->update();
        }
        else 
        {
            $news->where('IdD',$IdD);
            $news->set(
                [
                    
                    'Naziv'=>$this->request->getVar("naziv"),
                    'Cena'=>$this->request->getVar("cena"),
                    'Datum'=>$date,
                    'Lokacija'=>$this->request->getVar("lokacija"),
                    'Tip'=>"O",
                    'BrojKarata'=>$this->request->getVar("brojkarata"),
                    'KorIme'=>$this->session->get('user')->KorIme,
                    'Status'=>'N',
                    'Telefon'=> $this->request->getVar("telefon"), 
                ]
            );
            $news->update();
            
            
        }
             
             
             return redirect()->to(site_url($this->session->get('user')->Opis.'/userInfo'));
        
        
    }
        
        
        
        //Perin'o
        
        
        
        
   
    /**
     * Funkcija koja,ukoliko korisnik uneo ispravne podatke ,izvrsava transakciju
     * @return void
     */
    public function kupi()
    {
        if (isset($_SESSION['korpa']) && count($_SESSION['korpa']) > 0 && $this->validate(['brkartice'=>'required' , 'mesec'=>'required' , 'god'=>'required' ,  'cvc'=>'required']))
        {
            $newsDB = new News();
            $usersDB = new User();
            /*$korime = $this->session->get('user')->KorIme;
            $korisnik = $usersDB->where('KorIme', $korime)->find();*/

            $iddog = [];
            foreach ($_SESSION['korpa'] as $key => $value)
                array_push($iddog, $key);

            $news = $newsDB->findid($iddog);

            $suma = 0;

            $maxid = 0;
            $transakcijaDB = new Transakcija();
            $row = $transakcijaDB->selectMax("IdT");
            if(isset($row)) $maxid = $row->IdT;
            $maxid++;

            $stavka = new Stavka();
            foreach ($news as $dog)
            {
                $id = $dog->IdD;

                $s_data['IdD'] = $id;
                $s_data['Cena'] = $dog->Cena;
                $s_data['Kolicina'] = $_SESSION['korpa'][$id];
                $s_data['IdT'] = $maxid;
                $stavka->insert($s_data);
                //array_push($stavke, $s_data);

                $suma += $dog->Cena * $_SESSION['korpa'][$id];
            }
            $brkartice = $_POST['brkartice'];




            $transakcijaDB->insert(
                [
                    'Cena' => $suma,
                    'BrojKartice' => $brkartice,
                    'KorIme' => $this->session->get('user')->KorIme
                ]

            );
            unset($_SESSION['korpa']);

            $this->index();
            //$this->prikaz("index", []);
        }
        else
            return $this->korpa();
    }
     
      /**
     * Funkcija koja poziva stranicu za prikaz sadrzaja korpe korisnika
     * @return void
     */ 
     public function korpa()
    {
        $method = 'korpa';
        $newsDB = new News();
        $iddog = [];
        $news = [];
        if(isset($_SESSION['korpa'])) {
            foreach ($_SESSION['korpa'] as $key => $value) {
                array_push($iddog, $key);
            }
            if(count($iddog) > 0){$news = $newsDB->findid($iddog);}
        }
        $this->prikaz("korpa", ['news'=>$news, 'method'=>$method, 'opis'=>$this->session->get('user')->Opis, 'method'=>'korpa']);
    }



    
   
    //--------------------------------------------------------------------

}
