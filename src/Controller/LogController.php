<?php

namespace App\Controller;

use App\Form\LogSearchType;
use DateInterval;
use DateTimeImmutable;
use App\Service\LogService;
use App\Repository\LogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogController extends AbstractController
{
    
    #[Route('/log', name: 'app_log')]
    public function index(LogRepository $lr,Request $request, PaginatorInterface $paginator,LogService $ls): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $session = $request->getSession();
        //le code ci dessous à été placé dans /login
        // $session->set('isLogRegistered','0'); 

        $LogRegisteredStatus = boolval($session->get('isLogRegistered')); //Bool
        
        if($LogRegisteredStatus == false){
            $ls->newLog('Log','a consulter les logs ');
            $session->set('isLogRegistered','1');
        }
        
        $form = $this->createForm(LogSearchType::class);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                
                $query = $lr->search($form->getData());
                $pagination = $paginator->paginate(
                    $query,
                    $request->query->getInt('page',1),
                    10
                );
            }else{
                $pagination = $paginator->paginate(
                    $lr->PaginationQuery(),  //requête bdd
                    $request->query->get('page',1),
                    10
                );
            }

        
        return $this->render('log/index.html.twig',[
            'pagination' => $pagination,
            'form' => $form
        ]);
        
    }
    
}

        // public function index(LogRepository $lr, LogService $ls, Request $request): Response
        // {
        //     $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //     $date = new DateTimeImmutable();
        //     $more = $request->request->get('more');
    
        //     if(!$more){
        //         $dateLimit = $date->add(new DateInterval('P1M'));
        //         $logs = $lr->findLogsByDate($dateLimit);
    
        //     }else{
        //         $dateLimit = $date->add(new DateInterval('P1M'));
        //         $logs = $lr->findLogsByDate($dateLimit);
        //     }
    
    
    
            
        //     //? log
