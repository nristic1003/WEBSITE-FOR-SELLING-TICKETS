<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\News;
use CodeIgniter\Controller;
use App\Models\Transakcija;
use App\Models\Stavka;




class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
    
         /**
	 * Helperi za lakse upravljanje formom i url
	 *
	 * @var array 
	 */
	protected $helpers = ['form', 'url'];
        
        /**
         *
         * Informacija koja se salje navigaciji za prikaz informacije o trenutnoj stranici
         * 
         * @var string
         */
        protected $method = 'index';
        

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		 $this->session = session();
	}

    protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
      /**
	 * Funkcija za prikaz pocetne stranice
	 *
	 * @return void
	 */
    public function index()
    {
        $this->method = 'index';
        $newsDB = new News();
        $news = $newsDB->manifestacije(5);
        $data = [
            'news' => $news,
            'pager' => $newsDB->pager
        ];
        
        
        if($this->session->has('user'))
            $opis = $this->session->get('user')->Opis;
        else
            $opis = 'Gost';
        
        $this->prikaz("index", ['data'=>$data,'news'=>$news, 'method'=>$this->method, 'opis'=>$opis]);
    }
    
    /**
	 * Funkcija za pretragu manifestacija  i njihovu paginaciju
	 *
	 * @return void
	 */
    public function pretraga()
    {
        $this->method = 'index';
        $newsDB = new News();
        $news = $newsDB->pretraga(5, $this->request->getVar('search'));
        $data = 
        [
            'news' => $news,
            'pager' => $newsDB->pager
            
        ];
        
        if($this->session->has('user'))
            $opis = $this->session->get('user')->Opis;
        else
            $opis = 'Gost';
        
        $this->prikaz("index", ['data'=>$data , 'trazeno'=>$this->request->getVar('search'), 'method'=>$this->method, 'opis'=>$opis]);
    }
    
  
    
        /**
	 * Funkcija za prikaz oglasa i njihovu paginaciju
	 *
	 * @return void
	 */
    public function oglasi()
    {
        $newsDB = new News();
        $data = [
            'news' => $newsDB->oglasi(6),
            'pager' => $newsDB->pager
        ];
        $this->prikaz('oglasi',['data'=>$data,'method'=>'oglasi', /*'news'=>$news*/]);
    }
    
     /**
	 * Funkcija za objavljivanje oglasa korisnika
	 *
	 * @return void
	 */
    public function objaviOglas()
    {
        $naslov = 'Objavljivanje oglasa';
        $this->method='dodajOglas';
        $news = null;
        $this->prikaz('dodajOglas',['method'=>$this->method, 'news'=>$news, 'naslov'=>$naslov]);

    }
    
    
    
    
    

    /**
     * Funkcija za dodavanje manifestacije u korpu
     *
     *
     * @param int $iddog Predstavlja ID manifestacije
     * @return void
     */
    public function addtocart($iddog)
    {
        if(!isset($_SESSION['korpa'][$iddog]))
        {
            echo 1;
            $_SESSION['korpa'][$iddog] = 1;
        }
        else
        {
            echo 0;
        }

    }
    
     /**
     * Funkcija koja poziva stranicu za prikaz sadrzaja korpe gosta
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
        $this->prikaz("korpa", ['news'=>$news, 'method'=>$method]);
    }


    /**
     * Funkcija koja povecava broj karata za zeljenu manifestaciju
     * @return void
     */
    public function inccart($iddog)
    {
        $_SESSION['korpa'][$iddog] += 1;
    }
    
    
    /**
     * Funkcija koja smanjuje broj karata za zeljenu manifestaciju
     * @return void
     */
    public function deccart($iddog)
    {
        if($_SESSION['korpa'][$iddog] > 1)
        { $_SESSION['korpa'][$iddog] -= 1;}
    }

    /**
     * Funkcija koja uklanja zeljenu manifestaciju iz korpe
     * @return void
     */
    public function delcart($iddog)
    {
        unset($_SESSION['korpa'][$iddog]);
    }

}
