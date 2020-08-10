<?php namespace App\Controllers;
use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Transakcija;

/**
* Gost – klasa koja predstavlja rolu gosta tj. korisnika pre nego sto se loginuje
*
* @version 1.0
*/


class Gost extends BaseController
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
        $data['controller']='Gost';
        echo view('Prototip/header_gost',$data);
         echo view("Prototip/$page", $data);
         echo view("Prototip/footer", $data);

    }
    
    /**

     * Funkcija za prikaz stranice za login korisnika
     * @param string $poruka Parametar se koristi za informacije o greskama, ukoliko se korisnik bezuspesno logovao
     * @return void
     * 
     *      
     */
    public function login(string $poruka=null)
    {
        if($poruka!=null)
            $poruka= urldecode($poruka);
        $this->method = 'login';
        $this->prikaz("login", ['poruka'=>$poruka, 'method'=>$this->method]);
    }
    
     /**
     * Funkcija za prikaz stranice za registraciju korisnika
     * @param string $poruka Parametar se koristi za informacije, ukoliko se korsnik usepesno registrovao ili ukoliko se bezuspesno registrovao (zauzet email ili korisnicko ime)
     * @return void
     *      
     */
    public function forma($poruka=null)
    {
        $nil = null;
        $this->method = 'forma';
        $naslov = 'Registracija';
        $this->prikaz("forma", ['poruka'=>$poruka, 'method'=>$this->method, 'naslov'=>$naslov,'korisnik'=>$nil]);
    }
    
    
   /**

    * Funkcija koja prikuplja podatke iz forme za registraciju, vrsi validaciju tih podataka i upisuje novog korisnika u bazi, ukoliko je validacija uspensa. Ukoliko validacija nije uspesna, 
    * korisnik se obavestava
    * @return void 
    * 
    *     */
    public function registracija()
    {
        $nil = null;
        $this->method = 'forma';
        $userDB = new User();
        $role = new Role();

        if(!$this->validate(
            ['ime'=>'required|min_length[1]|max_length[20]',
            'prezime'=>'required|min_length[1]|max_length[20]',
            'korime'=>'trim|required|min_length[1]|max_length[15]',
            'email'=>'trim|required|min_length[1]|max_length[50]',
            'lozinka'=>'required|min_length[1]|max_length[20]',
            'telefon'=>'required|min_length[1]|max_length[15]',
            //'jmbg'=>'required|min_length[1]|max_length[13]',
            'brlk'=>'required|min_length[1]|max_length[9]',
            'grad'=>'required|min_length[1]|max_length[15]',
            'adresa'=>'required|min_length[1]|max_length[30]',
            'drzava' => 'required'
                ]
        )

        ) return $this->prikaz('forma', ['naslov'=>'Registracija' ,'errors'=>$this->validator->listErrors(), 'method'=>$this->method, 'korisnik'=>$nil]);

        $korisnik = $userDB->where('KorIme', $this->request->getVar("korime"))->find();
        if($korisnik==null)
        {
            $korisnik = $userDB->where('Email', $this->request->getVar("email"))->find();
            if($korisnik==null && $this->request->getVar("lozinka")==$this->request->getVar("ponlozinka")){
                $korime = $this->request->getVar("korime");
                $userDB->insert(
                [
                    'Ime'=>$this->request->getVar("ime"),
                    'Prezime'=>$this->request->getVar("prezime"),
                    'KorIme'=>$korime,
                    'Email'=>$this->request->getVar("email"),
                    'Sifra'=>md5($this->request->getVar("lozinka")),
                    'Telefon'=>$this->request->getVar("telefon"),
                    //'JMBG'=>$this->request->getVar("jmbg"),
                    'BRLK'=>$this->request->getVar("brlk"),
                    'Grad'=>$this->request->getVar("grad"),
                    'Adresa'=>$this->request->getVar("adresa"),
                    'Drzava' => $this->request->getVar("drzava")
                ]
                );
                 $role->insert(
                    [
                        'KorIme'=>$korime,
                        'IdU'=>3,  
                    ]
                 );
            }
            else
            {
                 return $this->forma("<font color='red' size='5px'>Email je zauzet!</font><br>");
            }
        }
        else
        {
            return $this->forma("<font color='red' size='5px'>Korisničko ime je zauzeto!</font><br>");
        }
        return $this->forma("<font color='green' size='5px'>Uspešno ste se registrovali :D</font><br>");



    }
    
/**

 * 
 * 
 * Funkcija koja prikuplja podatke sa staranice za login , proverava validnost tih podataka, dohvata korisnika iz baze po unetom korisnickom imenu
 * Ako korisik postoji u bazi, on se preusmerava na pocetnu stranicu za korisnika, a ako ne postoji korisnik se obavstava o tome.
 * @return type
 *  /    
 */
public function loginSubmit()
    {
        if(!$this->validate(['korime'=>'required' , 'lozinka'=>'required']))
            return $this->prikaz('login' ,['errors'=>$this->validator->getErrors()]);

        
        $db= \Config\Database::connect();
        $builder = $db->table('Ima_ulogu');
        $builder->select('*')
        ->join('Korisnik', 'Korisnik.KorIme=Ima_ulogu.KorIme', 'left') 
        ->join('Uloga', 'Uloga.Idu=Ima_ulogu.Idu', 'left')
        ->where('Korisnik.KorIme', $this->request->getVar('korime'));
        $user = $builder->get()->getFirstRow();

        //$userDB = new User();
        //$user = $userDB->find($this->request->getVar('korime'));


        if($user==null)
            return $this->login("Korisnik ne postoji");
        if($user->Sifra!=md5($this->request->getVar('lozinka')))
            return $this->login('Pogresna sifra');

        $this->session->set('user', $user);

        switch ($user->Opis)
        {
            case 'Admin': return redirect()->to(site_url('Admin')); break;
            case 'Moderator': return redirect()->to(site_url('Moderator')); break;
            case 'Korisnik':  return redirect()->to(site_url('Korisnik')); break;
        }
     
        
        
        //return redirect()->to(site_url('Korisnik'));
    }


    //--------------------------------------------------------------------

}
