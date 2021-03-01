<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Accommodation;
use App\Entity\Guest;
use DateInterval;
use DateTime;

class AccommodationFixtures extends Fixture implements DependentFixtureInterface
{
	public function getDependencies()
	{
		return ["App\\DataFixtures\\RoomFixtures"];
	}
	
	public function load(ObjectManager $manager)
	{

		$accommodation = new Accommodation();
			$accommodation->setStatus(0);
			$accommodation->setCheckInAt($this->after("P3D"));
			$accommodation->setCheckOutAt($this->after("P7D"));
			$accommodation->setBookAt($this->earlier("PT50M"));
			$accommodation->setRoomsAmount(1);
			$accommodation->setPeopleAmount(2);
			$accommodation->addRoom($this->getReference("room-201"));
			$manager->persist($accommodation);
		$guest = new Guest();
			$guest->setName("Tadeusz");
			$guest->setSurname("Szyszka");
			$guest->setNationality("PL");
			$guest->setUuid("00558777987");
			$guest->setEmail("tadeusz@szyszka.com.pl");
			$guest->setPhone("530 698 458");
			$guest->setRoles(["ROLE_GUEST"]);
			$accommodation->addGuest($guest);
			$manager->persist($guest);
		$guest = new Guest();
			$guest->setName("Monika");
			$guest->setSurname("Szyszka");
			$guest->setNationality("PL");
			$guest->setUuid("22555777888");
			$guest->setRoles(["ROLE_GUEST"]);
			$accommodation->addGuest($guest);
			$manager->persist($guest);


		$accommodation = new Accommodation();
			$accommodation->setStatus(3);
			$accommodation->setCheckInAt($this->earlier("P3D"));
			$accommodation->setCheckOutAt($this->after("P1D"));
			$accommodation->setBookAt($this->earlier("P14D"));
			$accommodation->setRoomsAmount(2);
			$accommodation->setPeopleAmount(1);
			$accommodation->addRoom($this->getReference("room-101"));
			$accommodation->addRoom($this->getReference("room-205"));
			$manager->persist($accommodation);
		$guest = new Guest();
			$guest->setName("Marcin");
			$guest->setSurname("Nowak");
			$guest->setNationality("EN");
			$guest->setUuid("4567981300");
			$guest->setEmail("marcin.nowak@email.com");
			$guest->setPhone("+44 550 666 444");
			$guest->setRoles(["ROLE_GUEST"]);
			$accommodation->addGuest($guest);
			$manager->persist($guest);
		
		
		$accommodation = new Accommodation();
			$accommodation->setStatus(3);
			$accommodation->setCheckInAt($this->earlier("P0D"));
			$accommodation->setCheckOutAt($this->after("P3D"));
			$accommodation->setBookAt($this->earlier("P1D"));
			$accommodation->setRoomsAmount(1);
			$accommodation->setPeopleAmount(1);
			$accommodation->addRoom($this->getReference("room-102"));
			$manager->persist($accommodation);
		$guest = new Guest();
			$guest->setName("Jan");
			$guest->setSurname("Kowalski");
			$guest->setNationality("PL");
			$guest->setUuid("11555666444");
			$guest->setEmail("guest@gmail.com");
			$guest->setPhone("+48 600 500 100");
			$guest->setRoles(["ROLE_GUEST"]);
			$accommodation->addGuest($guest);
			$manager->persist($guest);

		$manager->flush();
	}
	
	private function after(string $interval) : DateTime 
	{
		return (new DateTime())->add(new DateInterval($interval));
	}
	
	private function earlier(string $interval) : DateTime 
	{
		return (new DateTime())->sub(new DateInterval($interval));
	}
}
