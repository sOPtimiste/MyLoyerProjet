<?php

namespace App\DataFixtures;

use App\Entity\Contrat;
use App\Entity\Local;
use App\Entity\Site;
use App\Entity\TypeLocal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
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
            $manager->flush();




            for ($i = 1; $i < 3; $i++) {

                  $site = new Site();

                  $site->setNom('Keur awa')
                        ->setLieu($faker->address())
                        ->addLocal($local);




                  $manager->persist($site);
            }



            $manager->flush();



            //contratFixture


            for ($i = 1; $i < 5; $i++) {

                  $contrats = new Contrat();

                  $contrats->setNom('Article1')
                        ->setTypeContrat('CUH')
                        ->setCreateAt($faker->dateTimeI())
                        ->setDureeDeBail(mt_rand(2, 12))
                        ->setMontantDeCotion(mt_rand(200000, 900000))
                        ->setMontantDuMensualite(mt_rand(20000, 90000))
                        ->setLocal($local);
                  $manager->persist($contrats);
            }


            $manager->flush();
      }
}
