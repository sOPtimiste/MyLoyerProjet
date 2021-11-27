<?php

namespace App\DataFixtures;

use App\Entity\Bailleur;
use App\Entity\Contrat;
use App\Entity\Facture;
use App\Entity\Local;
use App\Entity\Locataire;
use App\Entity\Loi;
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

            //Type de Local Fixtures
            for ($i = 1; $i < 10; $i++) {
                  //Type de Local Fixtures
                  $typeLocal = new TypeLocal();

                  $typeLocal->setType('Appartement' . mt_rand(1, 9))
                        ->setDescription($faker->text(10));

                  //ajouter des fausses donnees au site
                  $site = new Site();

                  $site->setNom($faker->randomElement(["keur AWA", "Residence SALL", "Keur Khady", "Keur Ndiaga", "Keur SECK"]))
                        ->setLieu($faker->address());
                  for ($i = 1; $i < 20; $i++) {

                        //fixtures local

                        $local = new Local();

                        $local->setNom($faker->randomElement(["Immeuble SEEk", "Immeuble SALL", "Immeuble SY", "Immeuble LO", "Immeuble BOUSSO"]))
                              ->setAdresse($faker->address(5))
                              ->setIsEtat(mt_rand(0, 1))
                              ->setLongitude(mt_rand(-1000, 1500))
                              ->setLatitude(mt_rand(-1000, 15000))
                              ->setTypeLocal($typeLocal)
                              ->setSite($site);

                        for ($i = 1; $i < 10; $i++) {
                              $facture = new Facture();

                              $facture->setMontant(mt_rand(12000, 45000))
                                      ->setDateFacture($faker->dateTimeBetween('-3 month','now'))
                                      ->setLocal($local);
                              $manager->persist($facture);
                        }

                        //fixtures contrat      
                        $contrat = new Contrat();

                        $contrat->setNom($faker->randomElement(["contrat1", "contrat2", "Contrat3", "contrat4", "contrat5"]))
                                ->setTypeContrat($faker->randomElement(["typeContrat1", "typeContrat2", "typeContrat3", "typeContrat4", "typeContrat5"]))
                                ->setDateContrat($faker->dateTimeBetween('-3 month', 'now'))
                                ->setDureeDeBail(mt_rand(2, 12))
                                ->setMontantDeCotion(mt_rand(200000, 900000))
                                ->setMontantDuMensualite(mt_rand(20000, 90000))
                                ->setLocal($local);
                        $manager->persist($contrat);

                        //fixture loiS
                        $loi = new Loi();

                        $loi->setLibelle($faker->text(10))
                              ->setDateLoi($faker->dateTimeBetween('-4 month', 'now'))
                              ->setDescription($faker->text(15))
                              ->addContrat($contrat);

                        $manager->persist($loi);
                  }
                  $manager->persist($typeLocal);
                  $manager->persist($site);
            }

            for ($i = 1; $i < 5; $i++) {
                  //fixture pour bailleur
                  $bailleur = new Bailleur();
                  $bailleur->setLieuDeTravail($faker->text(6))
                           ->setNomAgence($faker->name())
                           ->setNbrImmeuble(mt_rand(2, 5))
                           ->addLocal($local);


                  //fixture locataire
                  $locataire = new Locataire();
                  $locataire->setTuteur($faker->name())
                            ->setTelTuteur($faker->phoneNumber())
                            ->setContrat($contrat);

                  // for($i = 1; $i < 5; $i++){
                        
                  //       $message = new Message();

                  //       $message->set

                  // }          


                  //fixture Superviseur
                  $superviseur = new Superviseur();
                  $superviseur->setNumDeLieu(mt_rand(2,10))
                              ->setNomDuMinistere($faker->name())
                              ->addContrat($contrat);
                           
                         




                  for ($i = 1; $i < 10; $i++) {

                        $user = new User();

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
                              ->setRoles(['ROLE_USER'])
                              ->setGenre($faker->randomElement(['male', 'femelle']))
                              ->setTelephone($faker->phoneNumber())
                              ->setProfession('Pharmacien')
                              ->setBailleur($bailleur)
                              ->setLocataire($locataire)
                              ->setSuperviseur($superviseur);

                        $manager->persist($user); 
                  }
                  $manager->persist($bailleur);
                  $manager->persist($locataire);
                  $manager->persist($superviseur);
                  
            }



            $manager->flush();
      }
}
