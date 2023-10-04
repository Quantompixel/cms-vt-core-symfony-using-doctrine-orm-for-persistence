<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $movies = [
            ["name" => "Avatar 2", "releaseYear" => 2022],
            ["name" => "The Batman", "releaseYear" => 2022],
            ["name" => "Spider-Man: No Way Home", "releaseYear" => 2021],
            ["name" => "Jurassic World: Dominion", "releaseYear" => 2022],
            ["name" => "Dune", "releaseYear" => 2021],
            ["name" => "No Time to Die", "releaseYear" => 2021],
            ["name" => "Black Widow", "releaseYear" => 2021],
            ["name" => "The Suicide Squad", "releaseYear" => 2021],
            ["name" => "A Quiet Place Part II", "releaseYear" => 2021],
            ["name" => "Shang-Chi and the Legend of the Ten Rings", "releaseYear" => 2021],
            ["name" => "Cruella", "releaseYear" => 2021],
            ["name" => "Fast & Furious 9", "releaseYear" => 2021],
            ["name" => "Venom: Let There Be Carnage", "releaseYear" => 2021],
            ["name" => "Jungle Cruise", "releaseYear" => 2021],
            ["name" => "The Conjuring: The Devil Made Me Do It", "releaseYear" => 2021],
            ["name" => "A Quiet Place", "releaseYear" => 2018],
            ["name" => "The Matrix 4", "releaseYear" => 2021],
            ["name" => "Godzilla vs. Kong", "releaseYear" => 2021],
            ["name" => "The French Dispatch", "releaseYear" => 2021],
            ["name" => "Candyman", "releaseYear" => 2021]
        ];

        foreach ($movies as $movie) {
            $movieEntity = new Movie();
            $movieEntity->setName($movie["name"]);
            $movieEntity->setReleaseYear($movie["releaseYear"]);
            $manager->persist($movieEntity);
        }

        $manager->flush();
    }
}
