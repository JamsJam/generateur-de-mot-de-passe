<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PasswordgeneratorController extends AbstractController
{  
    #[Route('/passwordgenerator', name: 'app_passwordgenerator')]
    public function index(): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER', 'Vous devez vous connecter');
        return $this->render('passwordgenerator/index.html.twig', [
            'controller_name' => 'PasswordgeneratorController',
        ]);
    }
}
