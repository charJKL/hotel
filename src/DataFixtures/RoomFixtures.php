<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Room;

class RoomFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		for($i = 100; $i < 110; $i++)
		{
			$room = new Room();
				$room->setNumber($i);
				$room->setType("fist");
				$manager->persist($room);
		}
		for($i = 200; $i < 210; $i++)
		{
			$room = new Room();
				$room->setNumber($i);
				$room->setType("two");
				$manager->persist($room);
		}
		
		$manager->flush();
	}
}