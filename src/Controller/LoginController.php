<?php

namespace App\Controller;

use App\Service\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils,LogService $ls): Response
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('app_user_manage');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
       // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        //? log
        $ls->newLog('deconnexion','s\'est connecter à l\'application ');
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    
    #[Route('/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(LogService $ls)
    {
        // 
        //? log
        $ls->newLog('deconnexion','s\'est déconnecter de l\'application ');

        }
}
