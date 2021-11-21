<?php

namespace App\Controller;

use App\Entity\Loi;
use App\Form\LoiType;
use App\Repository\LoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/loi")
 */
class LoiController extends AbstractController
{
    /**
     * @Route("/", name="loi_index", methods={"GET"})
     */
    public function index(LoiRepository $loiRepository): Response
    {
        return $this->render('loi/index.html.twig', [
            'lois' => $loiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="loi_new", methods={"GET", "POST"})
     */
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $loi = new Loi();
    //     $form = $this->createForm(LoiType::class, $loi);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($loi);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('loi_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('loi/new.html.twig', [
    //         'loi' => $loi,
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="loi_show", methods={"GET"})
    //  */
    // public function show(Loi $loi): Response
    // {
    //     return $this->render('loi/show.html.twig', [
    //         'loi' => $loi,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="loi_edit", methods={"GET", "POST"})
    //  */
    // public function edit(Request $request, Loi $loi, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(LoiType::class, $loi);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('loi_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('loi/edit.html.twig', [
    //         'loi' => $loi,
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="loi_delete", methods={"POST"})
    //  */
    // public function delete(Request $request, Loi $loi, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$loi->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($loi);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('loi_index', [], Response::HTTP_SEE_OTHER);
    // }
}
