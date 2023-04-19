<?php

namespace App\Controller;

use DateInterval;
use DateTimeImmutable;
use App\Entity\Registertoken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class RegisterCheckController extends AbstractController
{
    #[Route('/check', name: 'app_register_check')]
    public function index(): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        return $this->render('register_check/index.html.twig', [
            'controller_name' => 'RegisterCheckController',
        ]);
    }
    #[Route('/admin/ajax', name: 'app_register_ajax')]
    public function ajax(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        if (!$request->isXmlHttpRequest()) {
            throw new AccessDeniedException("Accès non autorisé");
        }else{
            
            function uniqidReal($lenght = 23) {
                // uniqid gives 3 chars, but you could adjust it to your needs.
            if (function_exists("random_bytes")) {
                $bytes = random_bytes(ceil($lenght / 2));
            } elseif (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
            } else {
                throw new Exception("no cryptographically secure random function available");
            }
            return substr(bin2hex($bytes), 0, $lenght);
            }
            $hashlink = password_hash(uniqidReal(), PASSWORD_DEFAULT);
        
            $link = new Registertoken();
            $link->setToken($hashlink);
            $link->setCreatedAt(new DateTimeImmutable());
            $link->setExpiredAt($link->getCreatedAt()->add(new DateInterval('PT24H')));
            $link->setUsable(true);


            
            $entityManager->persist($link);
            $entityManager->flush($link);
            
            return $this->json($hashlink);
        }
        
    }
};



