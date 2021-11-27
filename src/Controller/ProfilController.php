<?php

namespace App\Controller;

use App\Form\AccountType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="index_profil")
     * @IsGranted("ROLE_USER")
     */
    public function profil(): Response
    {
        return $this->render('profil/index.html.twig', [
            'profile' => $this->getUser()
        ]);
    }

    /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     * 
     * @Route("/account/profile", name="modif_profile")
     * @IsGranted("ROLE_USER")
     */
    public function profileEdit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

          $entityManager->persist($user);
          $entityManager->flush();

          $this->addFlash(
            'success',
            "Les données du profils ont été enregistrées avec succés !"
        );
        return $this->redirectToRoute('index_profil');
        }

       return $this->render('profil/modifProfil.html.twig', [
             'form'=> $form->createView()
       ]);
    }
}
