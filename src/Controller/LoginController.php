<?php

namespace App\Controller;

use App\Service\LogService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(Request $request,AuthenticationUtils $authenticationUtils,LogService $ls): Response
    {
        
        if ($this->getUser()) {
            //? log
            $ls->newLog('Connexion',' s\'est connecté sur le site ');
            $session = $request->getSession();
            $session->set('isLogRegistered','0'); //false
            $session->set('isLogAdminRegistered','0'); //false

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
          
            //     //? log
            $logService->newLog('Déconnexion',' s\'est déconnecté du site ');
            
            $security->logout(false);
            
            return $this->redirectToRoute('app_login');

        }
        return $this->redirectToRoute('app_user_manage');

    }
}
