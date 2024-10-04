<?php 


declare(strict_types= 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController{

    #[Route(path:"/admin")]
    public function admin(){
        return $this->render("admin.html.twig");
    }

    #[Route(path:"/admin/adminAddMovies")]
    public function adminAddMovies(){
        return $this->render("admin_add_films.html.twig");
    }

    #[Route(path:"/admin/adminMovies")]
    public function adminMovies(){
        return $this->render("admin_films.html.twig");
    }

    #[Route(path:"/admin/adminUsers")]
    public function adminUsers(){
        return $this->render("admin_users.html.twig");
    }

    #[Route(path:"/admin/upload")]
    public function upload(){
        return $this->render("upload.html.twig");
    }
    
}