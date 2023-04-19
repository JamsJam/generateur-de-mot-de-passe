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
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez vous connecter pour acceder a cette page');
        return $this->render('passwordgenerator/index.html.twig', [
            'controller_name' => 'PasswordgeneratorController',
        ]);
    }
}
