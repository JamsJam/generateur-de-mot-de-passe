<?php

namespace App\Controller;

use App\Repository\LogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogController extends AbstractController
{
    #[Route('/log', name: 'app_log')]
    public function index(LogRepository $lr,Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        

        $pagination = $paginator->paginate(
            $lr->PaginationQuery(),         //requête bdd
            $request->query->get('page',1),
            10
        );


        return $this->render('log/index.html.twig',[
            'pagination' => $pagination
        ]);
            
    }
}
