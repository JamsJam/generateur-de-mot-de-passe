<?php

namespace App\Controller;

use DateInterval;
use DateTimeImmutable;
use App\Service\LogService;
use App\Repository\LogRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogController extends AbstractController
{
    #[Route('/log', name: 'app_log')]
    public function index(LogRepository $lr, LogService $ls, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $date = new DateTimeImmutable();
        $more = $request->request->get('more');

        if(!$more){
            $dateLimit = $date->add(new DateInterval('P1M'));
            $logs = $lr->findLogsByDate($dateLimit);

        }else{
            $dateLimit = $date->add(new DateInterval('P1M'));
            $logs = $lr->findLogsByDate($dateLimit);
        }



        
        //? log
        $ls->newLog('log','a consulter les logs ');

        return $this->render('log/index.html.twig',[
            "logs" =>  $logs
        ]);
            
    }
}
