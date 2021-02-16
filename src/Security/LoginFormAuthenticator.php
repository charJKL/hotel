<?php

namespace App\Security;

use App\Entity\Guest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;


class LoginFormAuthenticator extends AbstractGuardAuthenticator implements PasswordAuthenticatedInterface
{
	private $session;
	private $urlGenerator;
	private $csrfTokenManager;
	private $passwordEncoder;
	private $security;

	private const ROUTE_LOGIN = "login";

	public function __construct(SessionInterface $session, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder, Security $security)
	{
		$this->session = $session;
		$this->urlGenerator = $urlGenerator;
		$this->csrfTokenManager = $csrfTokenManager;
		$this->passwordEncoder = $passwordEncoder;
		$this->security = $security;
	 }

	public function supports(Request $request)
	{
		return $request->attributes->get("_route") == self::ROUTE_LOGIN && $request->isMethod("POST");
	}

	public function supportsRememberMe()
	{
		return true;
	}
	
	public function start(Request $request, AuthenticationException $authException = null)
	{
		$url = $this->urlGenerator->generate(self::ROUTE_LOGIN);
		return new RedirectResponse($url);
	}

	public function getCredentials(Request $request)
	{
		$credentials = [
			'name' => $request->request->get('name'),
			'password' => $request->request->get('password'),
			'csrf_token' => $request->request->get('_csrf_token'),
		];
		$this->session->set(Security::LAST_USERNAME, $credentials['name']);
		return $credentials;
	}

	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		return $userProvider->loadUserByUsername($credentials["name"]);
	}

	public function checkCredentials($credentials, UserInterface $user)
	{
		$token = new CsrfToken('authenticate', $credentials['csrf_token']);
		if($this->csrfTokenManager->isTokenValid($token) == false) throw new InvalidCsrfTokenException();
		
		return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
	}

	/**
	 * Used to upgrade (rehash) the user's password automatically over time.
	 */
	public function getPassword($credentials): ?string
	{
		return $credentials['password'];
	}
	
	public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
	 {
		$SESSION_REDIRECT_FROM_KEY = "_security.$providerKey.target_path";
		if($this->session->has($SESSION_REDIRECT_FROM_KEY) == true)
		{
			$url = $this->session->get($SESSION_REDIRECT_FROM_KEY);
			return new RedirectResponse($url);
		}
		if($this->security->isGranted("ROLE_GUEST") == true)
		{
			$url = $this->urlGenerator->generate("lobby");
			return new RedirectResponse($url);
		}
		if($this->security->isGranted("ROLE_EMPLOYEE") == true)
		{
			$url = $this->urlGenerator->generate("office");
			return new RedirectResponse($url);
		}
	}
	
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
	{
		$this->session->set(Security::AUTHENTICATION_ERROR, $exception);
		
		$url = $this->urlGenerator->generate(self::ROUTE_LOGIN);
		return new RedirectResponse($url);
	}
}