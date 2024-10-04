<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $movie = new Movie();
            $movie ->setTitle("Star Wars ". $i);
            $movie ->setShortDescription("blablaba");
            $movie ->setLongDescription("blaaaaaaaaaaaaaaaaaaaaablaaaaaaaaaaaaaaaaaaaaaablaaaaaaaaaaaaaa");
            $movie ->setCoverImage("star_wars". $i .".png");
            $movie ->setRealeaseDateAt(new \DateTime("+. $i. day"));
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
