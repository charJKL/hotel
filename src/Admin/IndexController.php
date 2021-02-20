<?php
namespace App\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\ReservationRepository;
use App\Repository\RoomRepository;

/**
 * @Route("{_locale}/admin")
 * @IsGranted("ROLE_EMPLOYEE")
 */
class IndexController extends AbstractController
{
	private $roomRepository;
	private $reservationRepository;
	
	public function __construct(RoomRepository $roomRepository, ReservationRepository $reservationRepository)
	{
		$this->roomRepository = $roomRepository;
		$this->reservationRepository = $reservationRepository;
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
		$rooms = $this->roomRepository->findAll();
		$reservations = $this->reservationRepository->findAll();
		return $this->render("admin/assignment.html.twig", ["rooms" => $rooms, "reservations" => $reservations]);
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
	 * @Route("/reservation", name="admin/reservation");
	 */ 
	public function reservation() : Response
	{
		$reservations = $this->reservationRepository->findAll();
		return $this->render("admin/reservation.html.twig", ["reservations" => $reservations]);
	}
}