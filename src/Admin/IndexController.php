<?php
namespace App\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\AccommodationRepository;
use App\Repository\RoomRepository;
use DateInterval;
use \DateTime;

/**
 * @Route("{_locale}/admin")
 * @IsGranted("ROLE_EMPLOYEE")
 */
class IndexController extends AbstractController
{
	private $roomRepository;
	private $accommodationRepository;
	
	public $accommodationsRequireActions;
	
	public function __construct(RoomRepository $roomRepository, AccommodationRepository $accommodationRepository)
	{
		$this->roomRepository = $roomRepository;
		$this->accommodationRepository = $accommodationRepository;
		
		$this->accommodationsRequireActions = $this->accommodationRepository->findRequiredActions();
	}
	
	/**
	 * @Route("/", name="admin")
	 */ 
	public function index() : Response
	{
		return $this->redirectToRoute("admin/assignment");
	}
	
	/**
	 * @Route("/assignment", name="admin/assignment")
	 */
	public function assignment() : Response
	{
		$rooms = $this->roomRepository->findAllRoomInOrder();
		
		$from = (new DateTime("now"))->sub(new DateInterval("P3D")); // back 3 days earlier 
		$to = (new DateTime("now"))->add(new DateInterval("P30D")); // add 30 
		$accommodations = $this->accommodationRepository->findRoomAccommodation($from, $to);
		return $this->render("admin/assignment.html.twig", ["from" => $from, "rooms" => $rooms, "accommodations" => $accommodations]);
	}
	
	/**
	 * @Route("/rooms", name="admin/rooms")
	 */ 
	public function rooms() : Response
	{
		$rooms = $this->roomRepository->findAll();
		return $this->render("admin/rooms.html.twig", ["rooms" => $rooms]);
	}
	
	/**
	 * @Route("/accommodations", name="admin/accommodations");
	 */ 
	public function accommodations() : Response
	{
		$accommodations = $this->accommodationRepository->findAll();
		return $this->render("admin/accommodations.html.twig", ["accommodations" => $accommodations]);
	}
}