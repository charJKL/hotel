<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function homepage() : Response
	{
		return $this->render("homepage.html.twig");
	}
	
	public function offers() : Response
	{
		$offers = ["Frozen January", "Better Feburary", "Almost Sunny"]; // TODO query this from database
		return $this->render("homepage/offers.fragment.html.twig", ["offers" => $offers]);
	}
	
}