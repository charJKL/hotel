<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("{_locale}")
 * @IsGranted("ROLE_MANAGER")
 */
class AdminController extends AbstractController
{
	/**
	 * @Route("/admin", name="admin")
	 */
	public function homepage() : Response
	{
		$guest = $this->getUser();
		return $this->render("admin.html.twig", ["name" => $guest->getName()]);
	}
}