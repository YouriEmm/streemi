<?php 

declare(strict_types= 1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{

    #[Route(path:"/movie/{name}")]
    public function index(){
        return $this->render("");
    }
}