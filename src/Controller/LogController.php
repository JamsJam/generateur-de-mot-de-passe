<?php

namespace App\Controller;

use App\Repository\LogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogController extends AbstractController
{
    #[Route('/log', name: 'app_log')]
    public function index(LogRepository $lr): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $logs = $lr->findBy(
            [],["logAt" => "DESC"]

        );

        
        
        return $this->render('log/index.html.twig',[
            "logs" =>  $logs
        ]);
            
    }
}
