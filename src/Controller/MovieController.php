<?php 

declare(strict_types= 1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{

    #[Route(path:"/watch")]
    public function discover(){
        return $this->render("discover.html.twig");
    }

    #[Route(path:"watch/category/{categoryName}")]
    public function category(){
        return $this->render("category.html.twig");
    }

    #[Route(path:"watch/movie/{movieName}")]
    public function detailMovie(){
        return $this->render("detail.html.twig");
    }

    #[Route(path:"watch/serie/{serieName}")]
    public function detailSerie(){
        return $this->render("detail_serie.html.twig");
    }


}