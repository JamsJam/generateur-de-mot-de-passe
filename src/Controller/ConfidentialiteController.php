<?php

namespace App\Controller;

use App\Entity\Confidentialite;
use App\Form\ConfidentialiteType;
use App\Repository\ConfidentialiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/confidentialite')]
class ConfidentialiteController extends AbstractController
{
    #[Route('/', name: 'app_confidentialite_index', methods: ['GET'])]
    public function index(ConfidentialiteRepository $confidentialiteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('confidentialite/index.html.twig', [
            'confidentialites' => $confidentialiteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_confidentialite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConfidentialiteRepository $confidentialiteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $confidentialite = new Confidentialite();
        $form = $this->createForm(ConfidentialiteType::class, $confidentialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $confidentialiteRepository->save($confidentialite, true);

            return $this->redirectToRoute('app_confidentialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('confidentialite/new.html.twig', [
            'confidentialite' => $confidentialite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_confidentialite_show', methods: ['GET'])]
    public function show(Confidentialite $confidentialite): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('confidentialite/show.html.twig', [
            'confidentialite' => $confidentialite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_confidentialite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Confidentialite $confidentialite, ConfidentialiteRepository $confidentialiteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $form = $this->createForm(ConfidentialiteType::class, $confidentialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $confidentialiteRepository->save($confidentialite, true);

            return $this->redirectToRoute('app_confidentialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('confidentialite/edit.html.twig', [
            'confidentialite' => $confidentialite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_confidentialite_delete', methods: ['POST'])]
    public function delete(Request $request, Confidentialite $confidentialite, ConfidentialiteRepository $confidentialiteRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        if ($this->isCsrfTokenValid('delete'.$confidentialite->getId(), $request->request->get('_token'))) {
            $confidentialiteRepository->remove($confidentialite, true);
        }

        return $this->redirectToRoute('app_confidentialite_index', [], Response::HTTP_SEE_OTHER);
    }
}
