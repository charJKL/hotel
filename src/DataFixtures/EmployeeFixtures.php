<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Employee;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EmployeeFixtures extends Fixture
{
	private $passwordEncoder;

	public function __construct(UserPasswordEncoderInterface $passwordEncoder)
	{
		$this->passwordEncoder = $passwordEncoder;
	}
	
	public function load(ObjectManager $manager)
	{
		$employee = new Employee();
			$password = $this->passwordEncoder->encodePassword($employee, "password");
			$employee->setName("admin@gmail.com");
			$employee->setRoles(["ROLE_MANAGER"]);
			$employee->setPassword($password);
			$manager->persist($employee);
		
		$manager->flush();
	}
}
