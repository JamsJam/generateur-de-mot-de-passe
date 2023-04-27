<?php

namespace App\Controller;

use App\Service\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(LogService $ls): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //? log
        $ls->newLog('admin','s\'est connecter à l\'application ');
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
