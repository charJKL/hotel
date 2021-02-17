<?php
namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("{_locale}")
 */
class MainController extends AbstractController
{
	/**
	 * @Route("", name="homepage")
	 */
	public function homepage() : Response
	{
		return $this->render("view/homepage.html.twig");
	}
	
	/**
	 * @Route("/rooms", name="rooms");
	 */ 
	public function rooms() : Response
	{
		return $this->render("view/rooms.html.twig");
	}
	
	/**
	 * @Route("/recreation", name="recreation");
	 */ 
	public function recreation() : Response
	{
		return $this->render("view/recreation.html.twig");
	}

	/**
	 * @Route("/conferences", name="conferences");
	 */ 
	public function conferences() : Response
	{
		return $this->render("view/conferences.html.twig");
	}
	
	/**
	 * @Route("/gallery", name="gallery");
	 */ 
	public function gallary() : Response
	{
		return $this->render("view/gallery.html.twig");
	}
	
	/**
	 * @Route("/contact", name="contact");
	 */ 
	public function contact() : Response
	{
		return $this->render("view/contact.html.twig");
	}
	
	/**
	 * @Route("/offer/{slug}", name="offer")
	 */ 
	public function offer($slug, OfferRepository $offerRepository) : Response
	{
		$offer = $offerRepository->findOneBySlug($slug);
		if($offer == null) throw new NotFoundHttpException("Page doesn't exist"); // TODO change comment to "offer doesn't exist";
		
		return $this->render("view/offer.html.twig", ["offer" => $offer]);
	}
	
	public function offers(Request $request, OfferRepository $offerRepository) : Response
	{
		// TODO set cache headers
		$offers = $offerRepository->selectAllActive($request->getLocale());
		return $this->render("fragment/offers.html.twig", ["offers" => $offers]);
	}
}