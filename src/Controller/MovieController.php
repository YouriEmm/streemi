<?php 

declare(strict_types= 1);

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{

    #[Route(path:"/discover")]
    public function discover(){
        return $this->render("discover.html.twig");
    }

    #[Route(path:"category/{categoryName}")]
    public function category(){
        return $this->render("category.html.twig");
    }

    #[Route(path:"movie/{id}")]
    public function detailMovie(Movie $movie){
        $comments = $movie->getComments();

        return $this->render(
            "detail.html.twig",
            ['movie'=> $movie, 'comments'=> $comments]);
    }

    #[Route(path:"serie/{serieName}")]
    public function detailSerie(){
        return $this->render("detail_serie.html.twig");
    }


}