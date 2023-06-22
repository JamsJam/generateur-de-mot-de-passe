<?php

namespace App\Controller;

use Exception;
use DateInterval;
use DateTimeImmutable;
use App\Entity\Registertoken;
use App\Service\LogService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterCheckController extends AbstractController
{
    #[Route('/admin/check', name: 'app_register_check')]
    public function index(Request $request,MailerInterface $mailer, LogService $ls): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $formInput = null;
        $regex = "^[\w\.]+@([\w]+\.)+[\w]{2,4}^";
        $form = $this->createFormBuilder($formInput)
        ->add('email', EmailType::class, [
            'label' => 'À : '])
        ->add('link', HiddenType::class)
        ->add('submit', SubmitType::class, ['label' => 'Envoyer'])
        ->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid() && preg_match($regex,$form->get("email")->getData())) {
            
            $email = (new TemplatedEmail())
            
            ->from('nepasrepondre@studio-okai.com')

                ->to($form->get("email")->getData())

                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)

                ->subject('Inscription au gestionnaire de mot de passe')

                // ->text('Sending emails is fun again!')

                ->htmlTemplate('email_register.html.twig')
                ->context([
                    'link' => $form->get("link")->getData()
                    ])
                    ;
            $mailer->send($email);
            //? log
            $ls->newLog('Envoi Lien','a envoyé un lien d\'inscription à l\'adresse '.$form->get("email")->getData());
        }
        
        return $this->render('register_check/index.html.twig', [
            'form' => $form,
            'controller_name' => 'RegisterCheckController',
        ]);
    }
    #[Route('/admin/ajax', name: 'app_register_ajax')]
    public function ajax(EntityManagerInterface $entityManager, Request $request, LogService $ls): JsonResponse
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        if (!$request->isXMLHttpRequest()) {
            // throw new AccessDeniedException("Accès non autorisé");
            return $this->json('error');
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

            //? log
            $ls->newLog('Lien Généré','a généré un lien d\'inscription');
            
            return $this->json($hashlink);
        }
        
    }        
};