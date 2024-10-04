<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AuthController extends AbstractController{

    #[Route(path:"auth/login")]
    public function login(){
        return $this->render("login.html.twig");
    }

    #[Route(path:"auth/register")]
    public function register(){
        return $this->render("register.html.twig");
    }

    #[Route(path:"auth/confirm")]
    public function confirm(){
        return $this->render("confirm.html.twig");
    }

    #[Route(path:"auth/forgot")]
    public function forgot(){
        return $this->render("forgot.html.twig");
    }

    #[Route(path:"auth/reset")]
    public function reset(){
        return $this->render("reset.html.twig");
    }
}