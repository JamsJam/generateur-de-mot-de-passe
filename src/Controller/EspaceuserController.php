<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceuserController extends AbstractController
{
    #[Route('/manage', name: 'app_user_manage')]
    public function manage(): Response
  {
    $this->denyAccessUnlessGranted('ROLE_USER');
      
      return $this->render('user/manage.html.twig');
        
          
      }
}
