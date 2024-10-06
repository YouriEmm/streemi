<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Language;
use App\Enum\MediaTypeEnum;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $movie = new Movie();
            $movie ->setTitle("Film ". $i);
            $movie ->setShortDescription("Description du film ". $i);
            $movie ->setLongDescription("Longue description du film ". $i);
            $movie ->setCoverImage("film". $i .".png");
            $movie ->setRealeaseDateAt(new \DateTime());
            $movie -> setMediaType(MediaTypeEnum::MOVIE);
            $manager->persist($movie);
        }

        for ($i = 0; $i < 5; $i++) {
            $user = new User() ;
            $user ->setUsername("User" . $i);
            $user ->setEmail("blabla".$i."@example.com");
            $user ->setPassword("mdp");
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
            $manager->persist($user);
        }

        $category = [
            ['Action', 'action'],
            ['Aventure', 'aventure'],
            ['Comédie', 'comédie'],
            ['Drame', 'drame'],
            ['Science-fiction', 'sci-Fi']
        ];

        foreach ($category as $categoryData) {
            $category = new Category();
            $category->setName($categoryData[0]);
            $category->setLabel($categoryData[1]);
            $manager->persist($category);
        }


        $manager->flush();
    }
}
