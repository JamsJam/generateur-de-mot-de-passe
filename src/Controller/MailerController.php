<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'app_mail')]
    public function sendEmail(MailerInterface $mailer): Response
    {   
        
        $email = (new TemplatedEmail())
        ->from('nepasrepondre@studio-okai.com')
        ->to('')
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject('Inscription au gestionnaire de mot de passe')
        // ->text('Sending emails is fun again!')
        ->htmlTemplate('email_register.html.twig');
    $mailer->send($email);

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
