<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session = session();
        if ($session->has('user')){
            $korisnik = $session->get('user');
            if ($korisnik->Opis != 'Admin')
                return redirect()->to(site_url($korisnik->Opis));
        }
        else{
            return redirect()->to(site_url('Gost'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}