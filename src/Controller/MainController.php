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
use Exception;
use InvalidArgumentException;

/**
 * @Route("{_locale}")
 */
class MainController extends AbstractController
{
	/**
	 * Helper function to set flash messages.
	 */ 
	private function setFlash(string $name, bool $status, string $message)
	{
		$obj = new stdClass();
		$obj->status = ($status == true) ? "true" : "false";
		$obj->message = $message;
		$this->addFlash($name, $obj);
	}
	
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
	
	/**
	 * @Route("/book", methods={"POST"}, name="book")
	 */
	public function book(Request $request, EntityManagerInterface $em)
	{
		try
		{
			$contact = $request->request->get("contact");
			$amount = $request->request->get("amount");
			$rooms = $request->request->get("rooms");
			$start = $request->request->get("start");
			$end = $request->request->get("end");
			
			// TODO validate inputs, use symfony/forms
			if($contact == "") throw new InvalidArgumentException();
			if($amount == "") throw new InvalidArgumentException();
			if($rooms == "") throw new InvalidArgumentException();
			if($start == "") throw new InvalidArgumentException();
			if($end == "") throw new InvalidArgumentException();
			
			$reservation = new Reservation();
				$reservation->setContact($request->request->get("contact"));
				$reservation->setAmount($request->request->get("amount"));
				$reservation->setRooms($request->request->get("rooms"));
				$reservation->setStart(new DateTime($request->request->get("start")));
				$reservation->setEnd(new DateTime($request->request->get("end")));
				$reservation->setDate(new DateTime("now"));
				
			$em->persist($reservation);
			$em->flush();
			$this->setFlash("reservation.result", true, "reservation.reservation.saved");
		}
		catch(Exception $e) 
		{
			$this->setFlash("reservation.result", false, "reservation.reservation.error");
		}
		finally
		{
			return $this->redirectToRoute("homepage", [], 303);
		}
	}
	
	public function offers(Request $request, OfferRepository $offerRepository) : Response
	{
		// TODO set cache headers
		$offers = $offerRepository->selectAllActive($request->getLocale());
		return $this->render("fragment/offers.html.twig", ["offers" => $offers]);
	}
}