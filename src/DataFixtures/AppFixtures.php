<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Movie;
use App\Entity\Episode;
use App\Entity\Playlist;
use App\Entity\Subscription;
use App\Entity\Season;
use App\Entity\SubscriptionHistory;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Language;
use App\Entity\PlaylistMedia;
use App\Entity\PlaylistSubscription;
use App\Entity\Serie;
use App\Entity\WatchHistory;
use App\Enum\MediaTypeEnum;
use App\Enum\StatusCommentEnum;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $categoryEntities = [];

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
            $categoryEntities[] = $category;
        }

        $languageEntities = [];

        $language = [
            ['French', 0],
            ['English', 1],
            ['Spanish', 2],
            ['Russian', 3],
            ['Chinese', 4]
        ];

        foreach ($language as $languageData) {
            $language = new Language();
            $language->setName($languageData[0]);
            $language->setCode($languageData[1]);
            $manager->persist($language);
            $languageEntities[] = $language;
        }


        $movieTab =[];

        for ($i = 0; $i < 5; $i++) {
            $movie = new Movie();
            $movie ->setTitle("Film ". $i);
            $movie ->setShortDescription("Description du film ". $i);
            $movie ->setLongDescription("Longue description du film ". $i);
            $movie ->setCoverImage("film". $i .".png");
            $movie ->setRealeaseDateAt(new \DateTime());
            $movie ->setDuration(180);
            $movie ->setMediaType(MediaTypeEnum::MOVIE);
            $movie ->addCategoryMedium($categoryEntities[$i]);
            $movie->addMediaLanguage($languageEntities[$i]); 
            $movieTab[] = $movie;
            $manager->persist($movie);
        }

        for ($i = 0; $i < 5; $i++) {
            $serie = new Serie();
            $serie ->setTitle("Serie ". $i);
            $serie ->setShortDescription("Description de la Serie ". $i);
            $serie ->setLongDescription("Longue description de la Serie ". $i);
            $serie ->setCoverImage("Serie". $i .".png");
            $serie ->setRealeaseDateAt(new \DateTime());
            $serie ->addCategoryMedium($categoryEntities[$i]);
            $serie->addMediaLanguage($languageEntities[$i]);
            $serie -> setMediaType(MediaTypeEnum::SERIE);

            for ( $s = 0; $s < 3; $s++) {
                $season = new Season();
                $season ->setSeasonNumber($s);
                $season ->setSerie($serie);

                for($e = 0 ; $e < 10; $e++){
                    $episode = new Episode();
                    $episode ->setTitle("Episode". $e);
                    $episode->setDuration(40); 
                    $episode->setReleaseDateAt(new \DateTimeImmutable());
                    $episode->setSeason($season);

                    $season->addEpisode($episode);
                    $manager->persist($episode);
                }

                $serie->addSeason($season);
                $manager->persist($season);
            }
            $manager->persist($serie);
        }

        $subscriptionsEntities = [];


        $subscriptions = [
            ['Simple subscription', 5, 1],
            ['Premium subscription', 10, 2],
            ['INSANE PREMIUM', 25, 3],
        ];
        
        foreach ($subscriptions as $subscriptionsData) {
            $subscriptions = new Subscription();
            $subscriptions ->setName($subscriptionsData[0]);
            $subscriptions ->setPrice($subscriptionsData[1]);
            $subscriptions ->setDurationInMonths($subscriptionsData[2]);    
            $manager->persist($subscriptions);
            $subscriptionsEntities[] = $subscriptions;
        }

        $userTab = [];

        for ($i = 0; $i < 5; $i++) {
            $user = new User() ;
            $user ->setUsername("User" . $i);
            $user ->setEmail("blabla".$i."@example.com");
            $user ->setPassword("mdp");
            $user ->addCurrentSubscription($subscriptionsEntities[rand(0,2)]);
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
            $userTab[] = $user;
            $manager->persist($user);
        }
        
        foreach ($userTab as $userTabData) {
            $subHistory = new SubscriptionHistory();
            $subHistory ->setSubscriber($userTabData);
            $subHistory ->setSubscription($subscriptionsEntities[rand(0,2)]);
            $subHistory ->setStartDateAt(new \DateTimeImmutable(""));
            $subHistory->setEndDateAt(new \DateTimeImmutable(""));
            $manager->persist($subHistory);
        }

        foreach($userTab as $key => $userTabData){
            $comment = new Comment();
            $comment ->setContributor($userTabData);
            $comment ->setMedia($movieTab[rand(0,4)]);
            $comment ->setContent("Commentaire du user ". $key);
            $comment ->setStatus(StatusCommentEnum::POSTED);
            $manager->persist($comment);
        }

        foreach($userTab as $key => $userTabData){
            $watchHistory = new WatchHistory();
            $watchHistory ->setWatcher($userTabData);
            $watchHistory ->setMedia($movieTab[rand(0,4)]);
            $watchHistory ->setLastWatchedAt(new \DateTime(""));
            $watchHistory ->setNumberOfViews(rand(1,50));   
            $manager->persist($watchHistory);
        }

        $playlistTab = [];

        foreach($userTab as $key => $userTabData){
            $playlist = new Playlist();
            $playlist ->setCreator($userTabData);
            $playlist ->setName("Playlist numéro : ".$key);
            $playlist ->setCreatedAt(new \DateTimeImmutable(""));
            $playlist ->setUpdatedAt(new \DateTime(""));
            $playlistTab[] = $playlist;
            $manager->persist($playlist);
        }

        foreach($userTab as $key => $userTabData){
            $playlistSub = new PlaylistSubscription();
            $playlistSub ->setCreator($userTab[rand(0,4)]);
            $playlistSub ->setSubscriber($userTabData);
            $playlistSub ->setPlaylist($playlistTab[rand(0,4)]);
            $playlistSub ->setSubscribedAt(new \DateTime(""));
            $manager->persist($playlistSub);
        }

        foreach($playlistTab as $key => $playlistTabData){
            $playlistMedia = new PlaylistMedia();
            $playlistMedia ->setMedia($movieTab[rand(0,4)]);
            $playlistMedia ->setPlaylist($playlistTab[rand(0,4)]);
            $playlistMedia ->setAddedAt(new \DateTime(""));
            $manager->persist($playlistMedia);
        }

        $manager->flush();
    }
}
