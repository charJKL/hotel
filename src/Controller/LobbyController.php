<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("{_locale}")
 * @IsGranted("ROLE_GUEST")
 */
class LobbyController extends AbstractController
{
	/**
	 * @Route("/lobby", name="lobby")
	 */
	public function lobby() : Response
	{
		$guest = $this->getUser();
		return $this->render("view/lobby.html.twig", ["name" => $guest->getName()]);
	}
}