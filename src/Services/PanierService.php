<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService{
protected $session;

    public function __construct(SessionInterface $session){
        $this->session=$session;

    }

    public function getPanier() {
        return $this->session->get('panier' , []);
    }

    public function ajouter(int $id){
       // $panier=$this->session->get(['panier');
       $panier=$this->getPanier();
       foreach($panier as $item){
           /*if($item->id==$id){
               $item->
           }*/
       }
    }

}
