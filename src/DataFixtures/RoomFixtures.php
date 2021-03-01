<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Room;
use InvalidArgumentException;

class RoomFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		for($i = 100; $i < 110; $i++)
		{
			$room = new Room();
				$room->setNumber($i);
				$room->setFeatures($this->generateRoomFeatures(0, 3));
				$manager->persist($room);
				$this->addReference("room-$i", $room);
		}
		for($i = 300; $i < 303; $i++)
		{
			$room = new Room();
				$room->setNumber($i);
				$room->setFeatures($this->generateRoomFeatures(0, 3));
				$manager->persist($room);
				$this->addReference("room-$i", $room);
		}
		for($i = 200; $i < 206; $i++)
		{
			$room = new Room();
				$room->setNumber($i);
				$room->setFeatures($this->generateRoomFeatures(1, 2));
				$manager->persist($room);
				$this->addReference("room-$i", $room);
		}
		$manager->flush();
	}
	
	private function generateRoomFeatures(int $amountFrom, int $amountTo) : array
	{
		$FEATURES = ["one-bed", "two-bed", "three-bed", "large-bath", "high", "tv", "sea-view"];
		$LENGTH = count($FEATURES) - 1;
		if($amountFrom < 0) throw new InvalidArgumentException("Amount can't be negative value.");
		if($amountTo - $amountFrom > $LENGTH) throw new InvalidArgumentException("There are not enought options for that amount.");
		
		$list = [];
		$amount = rand($amountFrom, $amountTo);
		while($amount--)
		{
			do
			{
				// Very bad way of doing this: in a case of lot of features it's possible to wait very long time on last available indexes.
				// TODO change way how indexes are picked.
				$feature = $FEATURES[rand(0, $LENGTH)];
			}while(in_array($feature, $list));
			$list[] = $feature;
		}
		return $list;
	}
}