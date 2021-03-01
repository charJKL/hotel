<?php

namespace App\Easy;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Easy\AccommodationCrudController;
use App\Entity\Accommodation;
use App\Entity\Guest;
use App\Entity\Room;


class DashboardController extends AbstractDashboardController
{
	/**
	 * @Route("/easy")
	 */
	public function index(): Response
	{
		return $this->render("easy/dashboard.html.twig");
	}

	public function configureDashboard(): Dashboard
	{
		return Dashboard::new()->setTitle('Symfony Hotel');
	}

	public function configureMenuItems(): iterable
	{
		yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
		yield MenuItem::linkToRoute('Custom admin', 'fa fa-user-shield', 'admin');
		
		yield MenuItem::section("");
		yield MenuItem::linkToCrud("Accommodations", 'fa fa-list', Accommodation::class);
		yield MenuItem::linkToCrud("Add", 'fa fa-plus-square', Accommodation::class)->setController(AccommodationCrudController::class)->setAction("new");
		
		yield MenuItem::section("");
		yield MenuItem::linkToCrud("Guest", 'fa fa-list', Guest::class);
		
		yield MenuItem::section("");
		yield MenuItem::linkToCrud("Rooms", 'fa fa-list', Room::class);
	}
}
