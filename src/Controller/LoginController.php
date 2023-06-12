<?php

namespace App\Controller;

use App\Service\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, LogService $logService): Response
    {

        if ($this->getUser()) {
            $logService->newLog('Connexion', $this->getUser()->getPrenom(). ' c\'est connecté sur le site ');
            
            return $this->redirectToRoute('app_user_manage');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
       // last username entered by the user
       $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(Security $security,AuthenticationUtils $authenticationUtils,LogService $logService)
    {
        if ($this->getUser()) {
          
            $log =$logService->newLog('Déconnexion', $this->getUser()->getPrenom(). ' c\'est déconnecté du site ');
            
            $security->logout(false);
            
            return $this->redirectToRoute('app_login');
        }
        return $this->redirectToRoute('app_user_manage');

    }
}
