<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {
        // log access denied in database
        // code to log access denied in database

        // create a flash message
        $request->getSession()->getFlashBag()->add('note', 'Vous devez vous connectez avant d\'accéder à cet page.');

        // redirect to the route /manage
        $url = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost() . $request->getBaseUrl() . '/manage';
        return new Response('', 302, ['Location' => $url]);
    }
}
