<?php

namespace App\DataFixtures;

use App\Entity\Bailleur;
use App\Entity\Contrat;
use App\Entity\Local;
use App\Entity\Locataire;
use App\Entity\Site;
use App\Entity\Superviseur;
use App\Entity\TypeLocal;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
      private $passwordHasher;

      public function __construct(UserPasswordHasherInterface $passwordHasher)
      {
          $this->passwordHasher = $passwordHasher;
      }
      public function load(ObjectManager $manager): void
      {
            $faker = Factory::create('fr_FR');

            //TypeLocalFixtures
            for ($i = 1; $i < 4; $i++) {
                  $typeLocal = new TypeLocal();

                  $typeLocal->setType('Appartement' . mt_rand(1, 3))
                        ->setDescription($faker->text(10));
                  for ($i = 1; $i < 6; $i++) {

                        $local = new Local();

                        $local->setNom('Immeuble SALL')
                              ->setAdresse($faker->address())
                              ->setIsEtat(mt_rand(0, 1))
                              ->setLongitude(mt_rand(1000, 15000))
                              ->setLatitude(mt_rand(10000, 150000))
                              ->setTypeLocal($typeLocal);
                  }
                  $manager->persist($typeLocal);
            }
            //$manager->flush();




            for ($i = 1; $i < 3; $i++) {

                  $site = new Site();

                  $site->setNom('Keur awa')
                        ->setLieu($faker->address())
                        ->addLocal($local);




                  $manager->persist($site);
            }



            //$manager->flush();



            //contratFixture


            for ($i = 1; $i < 3; $i++) {

                  $contrats = new Contrat();

                  $contrats->setNom('Article1')
                        ->setTypeContrat('CUH')
                        ->setCreateAt($faker->dateTimeBetween('-3 month','now'))
                        ->setDureeDeBail(mt_rand(2, 12))
                        ->setMontantDeCotion(mt_rand(200000, 900000))
                        ->setMontantDuMensualite(mt_rand(20000, 90000))
                        ->setLocal($local);
                  $manager->persist($contrats);
                  
            }

            for ($i = 1; $i < 5; $i++) {

                  $user = new User();
                  $locataire = new Locataire();
                  $locataire->addUser($user);
                  
                  $superviseur = new Superviseur();
                  $bailleur = new Bailleur();

                  $user->setEmail($faker->email())
                       
                        ->setPassword($this->passwordHasher->hashPassword(
                              $user,
                        '12345678'
                        ))
                        ->setPrenom($faker->firstName())
                        ->setNom($faker->lastName())
                        ->setAge($faker->year())
                        ->setNationalite('Senegalaise')
                        ->setNumPiece('178765434321')
                        ->setRoles($faker->randomElement(['ROLE_USER','ROLE_BAILLEUR','ROLE_LOCATAIRE','ROLE_SUPERVISEUR','ROLE_ADMIN']))
                        ->setGenre($faker->randomElement(['male','femelle']))
                        ->setTelephone($faker->phoneNumber())
                        ->setProfession('Pharmacien')
                  ;      
                  $manager->persist($user);
                  
            }


            $manager->flush();
      }
}
