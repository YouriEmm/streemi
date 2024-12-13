<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{

    //probablement une page "mon profil" plus tard
    #[Route(path:"/user")]
    public function user(){
        return $this->render("");
    }

    #[Route(path:"user/myList",name: "myList" )]
    public function myList(){
        return $this->render("lists.html.twig");
    }
    
    #[Route(path:"user/abonnements")]
    public function abonnements(){
        return $this->render("abonnements.html.twig");
    }



}