<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyListController extends AbstractController{

    #[Route(path:"/myList")]
    public function index(){
        return $this->render("");
    }
}