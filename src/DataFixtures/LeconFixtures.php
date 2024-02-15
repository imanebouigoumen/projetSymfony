<?php

namespace App\DataFixtures;

use App\Entity\Lecon;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LeconFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher=$hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker= \Faker\Factory::create("fr_FR");
        $users=[];
        for($i=1 ; $i<=4 ; $i++){
            $user=new User();
            $user -> setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)->setPassword($this->hasher ->hashPassword($user,"secret"))
                ->setRoles(['ROLE_PROF'])
            ;
            $users [] =$user;
            $manager->persist($user);

        }

        for ($i=1 ; $i<=4 ; $i++){
            $lecon=new Lecon();
            $prof=$users[$faker->numberBetween(0,sizeof($users)-1)];
            $lecon->setNom($faker->name)->setDescription("<p>" .
                implode("</p><p>" , $faker->paragraphs()) . "</p>")
                ->setProfLecon($prof);
            if ($prof instanceof User)
                $prof->addLecon($lecon);
            $manager->persist($lecon);
        }

        $manager->flush();
    }
}
