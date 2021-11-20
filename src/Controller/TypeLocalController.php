<?php

namespace App\Controller;

use App\Entity\TypeLocal;
use App\Form\TypeLocalType;
use App\Repository\TypeLocalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/local")
 */
class TypeLocalController extends AbstractController
{
    /**
     * @Route("/", name="type_local_index", methods={"GET"})
     */
    public function index(TypeLocalRepository $typeLocalRepository): Response
    {
        return $this->render('type_local/index.html.twig', [
            'type_locals' => $typeLocalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_local_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeLocal = new TypeLocal();
        $form = $this->createForm(TypeLocalType::class, $typeLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeLocal);
            $entityManager->flush();

            return $this->redirectToRoute('type_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_local/new.html.twig', [
            'type_local' => $typeLocal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_local_show", methods={"GET"})
     */
    public function show(TypeLocal $typeLocal): Response
    {
        return $this->render('type_local/show.html.twig', [
            'type_local' => $typeLocal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_local_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeLocal $typeLocal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeLocalType::class, $typeLocal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('type_local_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_local/edit.html.twig', [
            'type_local' => $typeLocal,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="type_local_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeLocal $typeLocal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeLocal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeLocal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_local_index', [], Response::HTTP_SEE_OTHER);
    }
}
