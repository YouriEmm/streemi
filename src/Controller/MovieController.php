<?php 

declare(strict_types= 1);

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class MovieController extends AbstractController{

    #[Route(path:"/discover", name:"discover")]
    public function discover(){
        return $this->render("discover.html.twig");
    }

    #[Route(path:"category/{categoryName}",)]
    public function category(){
        return $this->render("category.html.twig");
    }

    #[Route(path:"movie/{id}")]
    public function detailMovie(Movie $movie){

        $comments = $movie->getComments();
        $casting = $movie->getCasting();
        $staff = $movie->getStaff();

        return $this->render(
            "detail.html.twig",
            [
                'media'=> $movie,
                'comments'=> $comments,
                'castings' => $casting,
                'staffs'=> $staff
            ]);
    }

    #[Route(path:"serie/{id}")]
    public function detailSerie(Serie $serie){

        $comments = $serie->getComments();
        $casting = $serie->getCasting();
        $staff = $serie->getStaff();

        return $this->render("detail.html.twig",
        [
            'media'=> $serie,
            'comments'=> $comments,
            'castings' => $casting,
            'staffs'=> $staff
        ]);
    }


}