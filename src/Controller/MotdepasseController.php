<?php

namespace App\Controller;

use App\Entity\Motdepasse;
use App\Form\MotdepasseType;
use App\Repository\MotdepasseRepository;
use App\Service\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/motdepasse')]
class MotdepasseController extends AbstractController
{
    #[Route('/', name: 'app_motdepasse_index', methods: ['GET'])]
    public function index(MotdepasseRepository $motdepasseRepository): Response
    {
        return $this->render('motdepasse/index.html.twig', [
            'motdepasses' => $motdepasseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_motdepasse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MotdepasseRepository $motdepasseRepository, LogService $logService): Response
    {
        $motdepasse = new Motdepasse();
        $user = $this->getUser();
        $motdepasse->setUser($user);
        $form = $this->createForm(MotdepasseType::class, $motdepasse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motdepasseRepository->save($motdepasse, true);
            $logService->newLog('Add mot de passe ', ' à ajouter un mot de passe pour le site '.$motdepasse->getWebsite().'');

            return $this->redirectToRoute('app_motdepasse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motdepasse/new.html.twig', [
            'motdepasse' => $motdepasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motdepasse_show', methods: ['GET'])]
    public function show(Motdepasse $motdepasse): Response
    {
        return $this->render('motdepasse/show.html.twig', [
            'motdepasse' => $motdepasse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_motdepasse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Motdepasse $motdepasse, MotdepasseRepository $motdepasseRepository, LogService $logService): Response
    {
        $form = $this->createForm(MotdepasseType::class, $motdepasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motdepasseRepository->save($motdepasse, true);
            $logService->newLog('Modify mot de passe ', ' à modifier un mot de passe pour le site '.$motdepasse->getWebsite().'');
            return $this->redirectToRoute('app_motdepasse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('motdepasse/edit.html.twig', [
            'motdepasse' => $motdepasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motdepasse_delete', methods: ['POST'])]
    public function delete(Request $request, Motdepasse $motdepasse, MotdepasseRepository $motdepasseRepository, LogService $logService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motdepasse->getId(), $request->request->get('_token'))) {
            $motdepasseRepository->remove($motdepasse, true);
            $logService->newLog('Delete mot de passe ', ' à supprimer un mot de passe pour le site '.$motdepasse->getWebsite().'');
        }

        return $this->redirectToRoute('app_motdepasse_index', [], Response::HTTP_SEE_OTHER);
    }
}
