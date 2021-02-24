<?php
namespace App\Admin;



use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\AccommodationRepository;
use App\Repository\RoomRepository;

/**
 * @Route("{_locale}/admin")
 * @IsGranted("ROLE_EMPLOYEE")
 */
class IndexController extends AbstractController
{
	private $roomRepository;
	private $accommodationRepository;
	
	public function __construct(RoomRepository $roomRepository, AccommodationRepository $accommodationRepository)
	{
		$this->roomRepository = $roomRepository;
		$this->accommodationRepository = $accommodationRepository;
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
		$accommodations = $this->accommodationRepository->findAll();
		return $this->render("admin/assignment.html.twig", ["rooms" => $rooms, "accommodations" => $accommodations]);
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