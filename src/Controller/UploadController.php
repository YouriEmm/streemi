<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController{

    #[Route(path:"/upload")]
    public function index(){
        return $this->render("");
    }
}