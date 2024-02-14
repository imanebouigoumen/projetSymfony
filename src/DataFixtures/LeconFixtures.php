<?php

namespace App\DataFixtures;

use App\Entity\Lecon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LeconFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker= \Faker\Factory::create("fr_FR");
        for ($i=1 ; $i<=4 ; $i++){
            $lecon=new Lecon();
            $lecon->setNom($faker->sentence)->setDescription("<p>" .
                implode("</p><p>" , $faker->paragraphs()) . "</p>");
            $manager->persist($lecon);
        }

        $manager->flush();
    }
}
