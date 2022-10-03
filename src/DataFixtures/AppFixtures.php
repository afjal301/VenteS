<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Client;
use App\Entity\Facture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(){
        $this->faker= Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $chrono = 0;
       for($i=0;$i<5;$i++) {
        $user = new User();
        $user->setPassword('password')
            ->setNom($this->faker->name())
            ->setEmail($this->faker->email())
            ->setPrenom($this->faker->firstName());

            $manager->persist($user);
        

        for ($i=0; $i <mt_rand(2,5); $i++) { 
            $client = new Client();
            $client->setNom($this->faker->name())
                ->setEmail($this->faker->email())
                ->setPrenom($this->faker->firstName())
                ->setCompany($this->faker->company());
                $manager->persist($client);
            for($i = 0; $i <mt_rand(1,5);$i++){
                $chrono++;
                $facture = new Facture();
                $facture->setMontant(mt_rand(5,5000))
                    ->setDate($this->faker->dateTimeBetween('-6 months'))
                    ->setClient($client)
                    ->setChrono($chrono)
                    ->setStatus($this->faker->randomElement(['PAYE','ENVOYER','ATTENTE']));
                    $manager->persist($facture);


            }
       }
    
            # code...
            
        }
        $manager->flush();
    }
}
