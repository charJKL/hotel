<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Guest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class GuestFixtures extends Fixture
{
	private $passwordEncoder;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}
	
	public function load(ObjectManager $manager)
	{
		$guest = new Guest();
			$password = $this->passwordEncoder->encodePassword($guest, "password");
			$guest->setName("Jan");
			$guest->setSurname("Kowalski");
			$guest->setNationality("PL");
			$guest->setUuid("11222444555");
			$guest->setEmail("jan.kowalski@gmail.com");
			$guest->setPhone("+45 000 555 666");
			$guest->setPassword($password);
			$manager->persist($guest);

		$guest = new Guest();
			$password = $this->passwordEncoder->encodePassword($guest, "password");
			$guest->setName("Marek");
			$guest->setSurname("Nowak");
			$guest->setNationality("PL");
			$guest->setUuid("00555777888");
			$guest->setEmail("marek.nowak@gmail.com");
			$guest->setPhone("600800111");
			$guest->setPassword($password);
			$manager->persist($guest);
		
		$manager->flush();
	}
}
