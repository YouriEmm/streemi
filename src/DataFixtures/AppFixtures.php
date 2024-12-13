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
use App\Entity\Subtitle;
use App\Entity\WatchHistory;
use App\Enum\MediaTypeEnum;
use App\Enum\StatusCommentEnum;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){

        $this -> passwordHasher = $passwordHasher;

    }

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

        $subtitleEntities = [];

        $subtitle = [
            ['French', 0],
            ['English', 1],
            ['Spanish', 2],
            ['Russian', 3],
            ['Chinese', 4]
        ];

        foreach ($subtitle as $subtitleData) {
            $subtitle = new Subtitle();
            $subtitle->setName($subtitleData[0]);
            $subtitle->setCode($subtitleData[1]);
            $manager->persist($subtitle);
            $subtitleEntities[] = $subtitle;
        }

        $movieTab =[];

        for ($i = 1; $i < 6; $i++) {
            $movie = new Movie();
            $movie ->setTitle("Film ". $i);
            $movie ->setShortDescription("Description du film ". $i);
            $movie ->setLongDescription("Longue description du film ". $i);
            $movie ->setCoverImage("film". $i .".png");
            $movie ->setRealeaseDateAt(new \DateTime());
            $movie ->setDuration(180);
            $movie ->setRating(rand(1,10));
            $movie ->setMediaType(MediaTypeEnum::MOVIE);
            $movie ->setCoverImage("https://picsum.photos/1920/1080?random={$i}");
            $movie ->setCasting([
                ['name' => 'John Doe', 'role' => 'Réalisateur', 'image' => 'https://i.pravatar.cc/150?u=John+Doe'],
                ['name' => 'Jane Doe', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Jane+Doe'],
                ['name' => 'Foo Bar', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Foo+Bar'],
                ['name' => 'Baz Qux', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Baz+Qux'],

            ]);
            $movie ->setStaff([
                ['name' => 'Alice Bob', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Alice+Bob'],
                ['name' => 'Charlie Delta', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Charlie+Delta'],
                ['name' => 'Eve Fox', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Eve+Fox'],
                ['name' => 'Grace Hope', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Grace+Hope'],
                ['name' => 'Ivy Jack', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Ivy+Jack'],
            ]);
            $movie ->setTrailer([
                ['platform'=> 'Youtube','link'=> '#'],
                ['platform'=> 'Twitter','link'=> '#'],
                ['platform'=> 'Allociné','link'=> '#'],
            ]);
            $movie ->addCategoryMedium($categoryEntities[rand(0,4)]);
            $movie->addMediaLanguage($languageEntities[rand(0,4)]); 
            $movie->addMediaSubtitle($subtitleEntities[rand(0,4)]);
            $movieTab[] = $movie;
            $manager->persist($movie);
        }

        $serieTab = [];

        for ($i = 1; $i < 6; $i++) {
            $serie = new Serie();
            $serie ->setTitle("Serie ". $i);
            $serie ->setShortDescription("Description de la Serie ". $i);
            $serie ->setLongDescription("Longue description de la Serie ". $i);
            $serie ->setCoverImage("https://picsum.photos/1920/1080?random={$i}");
            $serie ->setRealeaseDateAt(new \DateTime());
            $serie ->addCategoryMedium($categoryEntities[rand(0,4)]);
            $serie->addMediaLanguage($languageEntities[rand(0,4)]);
            $serie->addMediaSubtitle($subtitleEntities[rand(0,4)]);
            $serie ->setRating(rand(1,10));
            $serie->setCoverImage("https://picsum.photos/1920/1080?random={$i}");
            $serie ->setCasting([
                ['name' => 'Charlie Delta', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Charlie+Delta'],
                ['name' => 'Eve Fox', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Eve+Fox'],
                ['name' => 'Grace Hope', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Grace+Hope'],
                ['name' => 'Ivy Jack', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/150?u=Ivy+Jack'],
                ]);
            $serie ->setStaff([
                ['name' => 'Alice Bob', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Alice+Bob'],
                ['name' => 'Charlie Delta', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Charlie+Delta'],
                ['name' => 'Eve Fox', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Eve+Fox'],
                ['name' => 'Grace Hope', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Grace+Hope'],
                ['name' => 'Ivy Jack', 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u=Ivy+Jack'],
            ]);
            $serie ->setTrailer([
                ['platform'=> 'Youtube','link'=> '#'],
                ['platform'=> 'Twitter','link'=> '#'],
                ['platform'=> 'Allociné','link'=> '#'],
            ]);
            $serie -> setMediaType(MediaTypeEnum::SERIE);

            for ( $s = 1; $s < 4; $s++) {
                $season = new Season();
                $season ->setSeasonNumber($s);
                $season ->setSerie($serie);

                for($e = 1 ; $e < 11; $e++){
                    $episode = new Episode();
                    $episode ->setTitle("Episode". $e);
                    $episode->setDuration(40); 
                    $episode->setReleaseDateAt(new \DateTimeImmutable());
                    $episode->setSeason($season);
                    $episode->setEpisodeNumber($e);
                    $episode->setEpisodeDescription("azfazefaze jfnabfiupzefba fyezzgg èofazuehufbazufiuzvfvay uvazefuazevfu abazef bazubfuiazbefiz az azeyfazueebf azbef fvazeufiv azuev");
                    $episode->setEpisodeCoverImage("https://picsum.photos/300/300?random={$e}");
                    $season->addEpisode($episode);
                    $manager->persist($episode);
                }

                $serie->addSeason($season);
                $manager->persist($season);
            }
            $serieTab[] = $serie;
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
            $user = new User();
            $user->setUsername("User" . $i);
            $user->setEmail("user{$i}@example.com");

            $hashedPassword = $this->passwordHasher->hashPassword($user, 'mdp');
            $user->setPassword($hashedPassword);

            if ($i === 0) {
                $user->setRoles(['ROLE_ADMIN']);
            } elseif ($i === 4) {
                $user->setRoles(['ROLE_BANNED']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }

            $user->addCurrentSubscription($subscriptionsEntities[rand(0, 2)]);
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);

            $userTab[] = $user;
            $manager->persist($user);
        }

        foreach ($userTab as $userTabData) {
            $subHistory = new SubscriptionHistory();
            $subHistory->setSubscriber($userTabData);
            $subHistory->setSubscription($subscriptionsEntities[rand(0, 2)]);
            $subHistory->setStartDateAt(new \DateTimeImmutable());
            $subHistory->setEndDateAt(new \DateTimeImmutable());
            $manager->persist($subHistory);
        }

        foreach($userTab as $key => $userTabData) {
            $commentMovie = new Comment();
            $commentMovie->setContributor($userTabData);
            $commentMovie->setMedia($movieTab[rand(0, count($movieTab) - 1)]); 
            $commentMovie->setContent("Commentaire sur le film du user " . $key);
            $commentMovie->setStatus(StatusCommentEnum::POSTED);
            $commentMovie->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($commentMovie);
        
            $commentSerie = new Comment();
            $commentSerie->setContributor($userTabData);
            $commentSerie->setMedia($serieTab[rand(0, count($serieTab) - 1)]);
            $commentSerie->setContent("Commentaire sur la série du user " . $key);
            $commentSerie->setStatus(StatusCommentEnum::POSTED);
            $commentSerie->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($commentSerie);
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
