<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Reservation;
use App\Repository\OfferRepository;
use stdClass;
use DateTime;

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
		// TODO remove all this logic from backend, move it to frontend
		$calendar = [strtotime("first day of this month"), strtotime("first day of next month")];
		foreach($calendar as $key => $timestamp) // the purpose of loop is to transform timestamps to stdClasses
		{
			$month = new stdClass;
			$month->name = date("F", $timestamp); // TODO make it locale aware.
			$month->count = (int) date("t", $timestamp);
			$month->firstDay = date("N", $timestamp);
			for($i = 1; $i <= $month->count; $i++)
			{
				$day = new stdClass();
				$day->number = $i;
				$month->days[] = $day;
			} 
			$calendar[$key] = $month;
		}
		return $this->render("view/homepage.html.twig", ["calendar" => $calendar]);
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
	
	/**
	 * @Route("/book", methods={"POST"}, name="book")
	 */
	public function book(Request $request, EntityManagerInterface $em)
	{
		// TODO validate inputs, use symfony/forms
		$reservation = new Reservation();
			$reservation->setContact($request->request->get("contact"));
			$reservation->setAmount($request->request->get("amount"));
			$reservation->setRooms($request->request->get("rooms"));
			$reservation->setStart(new DateTime($request->request->get("start")));
			$reservation->setEnd(new DateTime($request->request->get("end")));
			$reservation->setDate(new DateTime("now"));
			
		$em->persist($reservation);
		$em->flush();
		
		return $this->redirectToRoute("homepage", [], 303);
	}
	
	public function offers(Request $request, OfferRepository $offerRepository) : Response
	{
		// TODO set cache headers
		$offers = $offerRepository->selectAllActive($request->getLocale());
		return $this->render("fragment/offers.html.twig", ["offers" => $offers]);
	}
}