<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Subscription extends AbstractController{

    #[Route(path:"/subscription")]
    public function index(){
        return $this->render("");
    }
}