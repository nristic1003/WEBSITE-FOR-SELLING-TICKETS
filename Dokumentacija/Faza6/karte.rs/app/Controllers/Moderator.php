<?php namespace App\Controllers;

use App\Models\User;
use App\Models\News;
use App\Models\Role;
use App\Models\Roles;
use App\Models\Transakcija;
use App\Models\Stavka;

class Moderator extends Korisnik{

    protected function prikaz($page, $data)
    {
        $data['controller']='Moderator';
        $data['user']=$this->session->get('user');
        echo view('Prototip/header_moderator', $data);
        echo view("Prototip/$page", $data);
        echo view("Prototip/footer", $data);

    }
    
	
	/**
	* Prikazuje stranicu gde se moderatoru ispisuju svi oglasi sortirani po oglasima koji nisu odboreni. Moderator i Admin mogu da ih odobre ili izbrisu.
	* 
	* @return void
	*/
    public function moderatorMode()
    {
        $this->method = 'userInfo';
        $newsDB = new News();
        $news = $newsDB->svioglasi(5);
        $data = [
            'news' => $news,
            'pager' => $newsDB->pager
        ];

        $this->prikaz("moderatorOglasi", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'oglasi'=>$news]);


    }
     /**
     * Funkcija za pretragu registrovanih korsinika
     *
     * @return void
     */
     public function pretragaOglasa()
    {
        $ime = $this->request->getVar('pretraziKorisnike');
        if($ime==null)
            $ime="";
        $this->method = 'userInfo';
        $newsDB = new News();
        $news = $newsDB->pretragaOglasa(5,$ime);
        $data = [
            'news' => $news,
            'pager' => $newsDB->pager
        ];

        $this->prikaz("moderatorOglasi", ['data'=>$data,'method' =>  $this->method ,'admin'=>  $korime = $this->session->get('user')->KorIme, 'oglasi'=>$news]);

    }
    
    
   
	
  
    
        
 
    
	
    
    
     /**
     * Funkcija za brisanje oglasa iz baze. Poziva se unutar AJAX-a.
     *
	 *
     * @return void
     */
    
    public function obrisiOglas()
    {
        $oglasi = $_POST['favorite'];
        $newsDB = new News();
        foreach ($oglasi as $oglas)
        {
            $newsDB->where("IdD", $oglas)->delete();
        }
        $response['favorite'] = $oglasi;

        echo json_encode($response);
        
        //$this->moderatorMode();

    }
	  /**
     * Funkcija za menjanje statusa oglasa u bazi . Poziva se unutar AJAX-a.
     *
	 *
     * @return void
     */
    public function promeniStatus()
    {
        echo var_dump($_POST['favorite']);
        $oglasi = $_POST['favorite'];
        $newsDB = new News();
        foreach ($oglasi as $oglas)
        {
            $newsDB->where("IdD", $oglas);
            $newsDB->set(
                [
                    "Status"=>"A"
                ]
            );
            $newsDB->update();
        }
        $response['favorite'] = $oglasi;

        echo json_encode($response);
        
       

    }
   
}

?>