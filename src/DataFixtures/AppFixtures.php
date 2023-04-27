<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Motdepasse;
use App\Entity\Confidentialite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends Fixture
{
    /**
     *  @var Generator
     */
    private Generator $faker;

    public function __construct()   
    {
        $this->faker = Factory::create('fr__FR');
    }

    public function load(ObjectManager $manager): void
    {

        $confidentialite1 =  new Confidentialite();
        $confidentialite2 =  new Confidentialite();

        $confidentialite1
            ->setAcces("public");

        $confidentialite2
            ->setAcces("privé");


        $manager->persist($confidentialite1);
        $manager->persist($confidentialite2);
        $manager->flush();
        

        
        for($i = 0; $i < 10; $i++){

            
            $user = new User();
            
            
            $user
                ->setNom($this->faker->lastName)
                ->setPrenom($this->faker->firstName)
                ->setEmail($this->faker->email)
                ->setPassword($this->faker->password)
                ->setRoles(["ROLE_USER"]);

            $manager->persist($user);
            $manager->flush()
            ;

        }

        for ($i=0; $i < 40; $i++) { 
            
            $motdepasse = new Motdepasse();

            $motdepasse
                ->setWebsite($this->faker->url)
                ->setUsername($this->faker->userName)
                ->setPassword($this->faker->password);

                $users = $manager->getRepository(User::class)->findAll();
                $access = $manager->getRepository(Confidentialite::class)->findAll();

                $motdepasse->setUser($users[array_rand($users)]);
                $motdepasse->addAccess($access[array_rand($access)]);
                ;

            $manager->persist($motdepasse);
            $manager->flush();
        }

        
    }
}
