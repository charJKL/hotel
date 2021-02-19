<?php

namespace App\Controller;

use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("{_locale}")
 */
class SecurityController extends AbstractController
{
	/**
	 * @Route("/login", name="login", priority=2)
	 */
	public function login(Request $request, LoginFormAuthenticator $loginAuthenticator): Response
	{
		
		if($this->isGranted("ROLE_USER") == true)
		{
			return $loginAuthenticator->onAuthenticationSuccessRedirect($request, "main");
		}
		
		return $this->render('view/login.html.twig');
	}

	/**
	 * @Route("/logout", name="logout", priority=2)
	 */
	public function logout()
	{
		throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
	}
}
