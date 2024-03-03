<?php

namespace App\DataFixtures;

use App\Entity\Ingrediant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{

    private Generator $faker;
    public function __Construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($i=1;$i<=50;$i++)
        {
            $ingrediant = new Ingrediant();
            $ingrediant->setName($this->faker->word)
                ->setPrix(mt_rand(0, 100));
            $manager-> persist($ingrediant);

            $manager-> persist($ingrediant);

        }

         $manager-> persist($ingrediant);

        $manager->flush();
    }
}
