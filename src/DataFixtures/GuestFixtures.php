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
			$guest->setName("admin@gmail.com");
			$guest->setRoles(["ROLE_USER"]);
			$guest->setPassword($password);
			$manager->persist($guest);
		
		$manager->flush();
	}
}
