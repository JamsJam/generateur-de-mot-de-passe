<?php

namespace App\Controller;

use App\Entity\Log;
use App\Entity\User;
use DateTimeImmutable;
use App\Service\LogService;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RegistertokenRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Model\VerifyEmailSignatureComponents;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository, RegistertokenRepository $tokenRepo,MailerInterface $mailer, LogService $ls): Response
    {   
        
        
        $token = $request->query->get('token');

        $tokenInDatabase = $tokenRepo->findOneBy(['token' => $token, 'usable' => '1' ]);

        if(!$token || !$tokenInDatabase){
            return $this->redirectToRoute('app_login',);
        }else{
            $user = new User();
            $form = $this->createForm(RegistrationFormType::class, $user);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                
                // encode the plain password
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                        )
                    );
                    
                    $entityManager->persist($user);
                    
                    // $userRepository->save($user, true);
                    
                    //?     =========================
                    //*     ajouter log d'inscription
                    //?     =========================
                    
                    $log = new Log();
                    $log->setUser($user);
                    $log->setCategory('inscription');
                    $log->setLogAt(new DateTimeImmutable());
                    $log->setMessage(' s\'est inscrit sur le site');
                    
                    $entityManager->persist($log);
                    
                    //?     =========================
                    $tokenInDatabase->setUsable(0);
                    $entityManager->flush($tokenInDatabase);
                    $entityManager->flush();
                    
                    
                    //? log
                    $ls->newLog('inscription','s\'est inscrit sur le site ');
                    
                    // generate a signed url and email it to the user
                    $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('contact@studiookai.com', 'Studio Okai'))
                        ->to($user->getEmail())
                        ->subject('Mail de confirmation')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );

                return $this->redirectToRoute('app_home');
            }
        
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    };
    }

    
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {     
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            
            // validate email confirmation link, sets User::isVerified=true and persists
            try {
                $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
                
            } catch (VerifyEmailExceptionInterface $exception) {
                $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
                $this->addFlash('mail_error','la vérification à échouée veuillez contacter les administrateurs du site');
                
                return $this->redirectToRoute('app_login');
            }
            
            // @TODO Change the redirect on success and handle or remove the flash message in your templates
            $this->addFlash('mail_success', 'Your email address has been verified.');
            
            return $this->redirectToRoute('app_user_manage');
        }
}
