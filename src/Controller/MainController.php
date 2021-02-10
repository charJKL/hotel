<?php
namespace App\Controller;

use App\Repository\OfferRepository;
use stdClass;
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
		// TODO remove all this logic from backend, move it to frontend
		$calendar = [time(), strtotime("next month")]; // timestamp of current month and next month
		foreach($calendar as $key => $timestamp) // the purpose of loop is to transform timestamps to stdClasses
		{
			$month = new stdClass;
			$month->name = date("F", $timestamp); // TODO make it locale aware.
			$month->count = date("t", $timestamp);
			for($i = 1; $i <= $month->count; $i++)
			{
				$day = new stdClass();
				$day->number = $i;
				$month->days[] = $day;
			} 
			$calendar[$key] = $month;
		}
		return $this->render("homepage.html.twig", ["calendar" => $calendar]);
	}
	
	/**
	 * @Route("/offer/{slug}", name="offer")
	 */ 
	public function offer($slug, OfferRepository $offerRepository) : Response
	{
		$offer = $offerRepository->findOneBySlug($slug);
		if($offer == null) throw new NotFoundHttpException("Page doesn't exist"); // TODO change comment to "offer doesn't exist";
		
		return $this->render("offer.html.twig", ["offer" => $offer]);
	}
	
	public function offers(Request $request, OfferRepository $offerRepository) : Response
	{
		// TODO set cache headers
		$offers = $offerRepository->selectAllActive($request->getLocale());
		return $this->render("homepage/offers.fragment.html.twig", ["offers" => $offers]);
	}
}