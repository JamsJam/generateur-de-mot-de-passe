<?php

namespace App\Controller;

use App\Service\LogService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(LogService $ls, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //? log
        
        $session = $request->getSession();
        //le code ci dessous à été placé dans /login
        // $session->set('isLogAdminRegistered','0'); 

        $LogRegisteredStatus = boolval($session->get('isLogAdminRegistered')); //:Bool
        
        
        if($LogRegisteredStatus == false){
            $session->set('isLogAdminRegistered','1');
            $ls->newLog('Connexion Admin','s\'est rendu sur la partie administrateur ');
        }
        
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
